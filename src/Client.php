<?php

declare(strict_types=1);

namespace EzeepBlueApi;

use EzeepBlueApi\Enums\Endpoints;
use EzeepBlueApi\Resources\AccountApi;
use EzeepBlueApi\Resources\PrintApi;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\Exception\ClientException;

/**
 * Class Client
 * @package EzeepBlueApi
 */
class Client
{
    /**
     * @var \EzeepBlueApi\Config
     */
    private Config $config;

    /**
     * @var \EzeepBlueApi\Helpers
     */
    private Helpers $helpers;

    /**
     * @var \GuzzleHttp\Client
     */
    private HttpClient $client;

    /**
     * @var \EzeepBlueApi\Resources\PrintApi
     */
    public PrintApi $print;
    /**
     * @var \EzeepBlueApi\Resources\AccountApi
     */
    private AccountApi $account;

    /**
     * Client constructor.
     * @param \EzeepBlueApi\Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->helpers = new Helpers();

        $this->print = new PrintApi($this);
        $this->account = new AccountApi($this);
    }

    /**
     *
     */
    public function accountClient()
    {
        $this->client = new HttpClient([
            'base_uri' => $this->config->getAccountApiUrl(),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->config->getAccessToken(),
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    /**
     *
     */
    public function printClient()
    {
        $this->client = new HttpClient([
            'base_uri' => $this->config->getPrintApiUrl(),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->config->getAccessToken(),
                'Content-Type' => 'application/json'
            ]
        ]);
    }

    /**
     * @return string
     */
    public function getAuthorizationUrl(): string
    {
        $params = [
            'response_type' => 'code',
            'client_id' => $this->config->getClientId(),
            'redirect_uri' => $this->config->getRedirectUri()
        ];

        return sprintf('%s/%s?%s', $this->config->getAccountApiUrl(), Endpoints::OAUTH_AUTHORIZE(), $this->helpers->queryParams($params));
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getAuthorizationCode(string $key = 'code')
    {
        return $_REQUEST[$key];
    }

    /**
     * @param string|null $code
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccessToken(?string $code = null): string
    {
        if (is_null($code) || empty($code)) {
            $code = $this->getAuthorizationCode();
        }

        $client = new HttpClient([
            'base_uri' => $this->config->getAccountApiUrl(),
            'headers' => [
                'Authorization' => "Basic " . $this->config->getSecretHeader(),
                'content-type' => 'application/x-www-form-urlencoded',
            ],
        ]);

        try {
            $result = $client->request("POST", sprintf('%s/%s', $this->config->getAccountApiUrl(), Endpoints::OAUTH_ACCESS_TOKEN()), [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                    'client_id' => $this->config->getClientId(),
                    'redirect_uri' => $this->config->getRedirectUri()
                ],
            ]);

            $result->getBody()->getContents();
        } catch (ClientException $exception) {
            return $exception->getResponse()->getBody()->getContents();
        }
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function refreshToken(): string
    {
        $client = new HttpClient([
            'base_uri' => $this->config->getAccountApiUrl(),
            'headers' => [
                'Authorization' => "Basic " . $this->config->getSecretHeader(),
                'content-type' => 'application/x-www-form-urlencoded',
            ],
        ]);

        try {
            $result = $client->request("POST", sprintf('%s/%s', $this->config->getAccountApiUrl(), Endpoints::OAUTH_ACCESS_TOKEN()), [
                'form_params' => [
                    'grant_type' => 'refresh_token',
                    'refresh_token' => $this->config->getRefreshToken(),
                ],
            ]);

            return $result->getBody()->getContents();
        } catch (ClientException $exception) {
            return $exception->getResponse()->getBody()->getContents();
        }
    }

    /**
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function get(Endpoints $endpoints, array $params = [])
    {
        try {
            $params = array_filter($params);

            $result = $this->client->get($endpoints->getValue(), $params);
            return $result->getBody()->getContents();
        } catch (ClientException $exception) {
            return $exception->getResponse()->getBody()->getContents();
        }
    }

    public function post(Endpoints $endpoints, array $params = [])
    {
        try {
            $params = array_filter($params);

            $result = $this->client->post($endpoints->getValue(), ['json' => $params]);
            return $result->getBody()->getContents();
        } catch (ClientException $exception) {
            print $exception->getMessage();
            return $exception->getResponse()->getBody()->getContents();
        }
    }

    public function put(Endpoints $endpoints, array $params = [])
    {

    }

    public function delete(Endpoints $endpoints, array $params = [])
    {

    }

    public function testAuth()
    {
        $client = new HttpClient([
            'base_uri' => 'https://accounts.ezeep.com',
            'headers' => [
                'Authorization' => "Basic " . $this->config->getSecretHeader(),
                'content-type' => 'application/x-www-form-urlencoded',
            ],
        ]);

        try {
            $res = $client->request("POST", "/oauth/access_token", [
                'form_params' => [
                    'grant_type' => 'password',
                    'username' => 'jusajdurim@gmail.com',
                    'password' => '57iDx@cs$cXDLZ$'
                ],
            ]);

            return $res->getBody()->getContents();

        } catch (ClientException $exception) {
            print $exception->getMessage();
            return $exception->getResponse()->getBody()->getContents();
        }
    }

    /**
     * Returns if the access_token is expired.
     * @return bool Returns True if the access_token is expired.
     */
    public function isAccessTokenExpired(): bool
    {
        if (!$this->config->getAccessToken()) {
            return true;
        }

        $created = 0;
        $accessToken = $this->config->getAccessToken();
        if (substr_count($accessToken, '.') == 2) {
            $parts = explode('.', $accessToken);
            $payload = json_decode(base64_decode($parts[1]), true);
            if ($payload && isset($payload['iat'])) {
                $created = $payload['iat'];
            }
        }

        // If the token is set to expire in the next 30 seconds.
        return ($created + ($this->config->getExpiresIn() - 30)) < time();
    }


}