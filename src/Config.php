<?php

declare(strict_types=1);

namespace EzeepBlueApi;

/**
 * Class Config
 * @package EzeepBlueApi
 */
class Config
{
    /**
     * @var string
     */
    private string $accountApiUrl = "https://account.ezeep.com";
    /**
     * @var string
     */
    private string $printApiUrl = "https://printapi.ezeep.com";

    /**
     * @var string
     */
    private string $client_id;
    /**
     * @var string
     */
    private string $client_secret;

    /**
     * @var string
     */
    private string $redirectUri;

    /**
     * @var string|null
     */
    private ?string $accessToken;

    /**
     * @var string|null
     */
    private ?string $refreshToken;

    /**
     * Config constructor.
     * @param string $client_id
     * @param string $client_secret
     * @param string $redirect_uri
     * @param string|null $accessToken
     * @param string|null $refreshToken
     */
    public function __construct(string $client_id, string $client_secret, string $redirect_uri, string $accessToken = null, string $refreshToken = null)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->redirectUri = $redirect_uri;
        $this->accessToken = $accessToken;
        $this->refreshToken = $refreshToken;
    }

    /**
     * @return string
     */
    public function getAccountApiUrl(): string
    {
        return $this->accountApiUrl;
    }

    /**
     * @param string $accountApiUrl
     */
    public function setAccountApiUrl(string $accountApiUrl): void
    {
        $this->accountApiUrl = $accountApiUrl;
    }

    /**
     * @return string
     */
    public function getPrintApiUrl(): string
    {
        return $this->printApiUrl;
    }

    /**
     * @param string $printApiUrl
     */
    public function setPrintApiUrl(string $printApiUrl): void
    {
        $this->printApiUrl = $printApiUrl;
    }

    /**
     * @return string
     */
    public function getClientId(): string
    {
        return $this->client_id;
    }

    /**
     * @param string $client_id
     */
    public function setClientId(string $client_id): void
    {
        $this->client_id = $client_id;
    }

    /**
     * @return string
     */
    public function getClientSecret(): string
    {
        return $this->client_secret;
    }

    /**
     * @param string $client_secret
     */
    public function setClientSecret(string $client_secret): void
    {
        $this->client_secret = $client_secret;
    }

    /**
     * @return string
     */
    public function getRedirectUri(): string
    {
        return $this->redirectUri;
    }

    /**
     * @param string $redirectUri
     */
    public function setRedirectUri(string $redirectUri): void
    {
        $this->redirectUri = $redirectUri;
    }

    /**
     * @return string|null
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * @param string|null $accessToken
     */
    public function setAccessToken(?string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @return string|null
     */
    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    /**
     * @param string|null $refreshToken
     */
    public function setRefreshToken(?string $refreshToken): void
    {
        $this->refreshToken = $refreshToken;
    }


    /**
     * @return string
     */
    public function getSecretHeader(): string
    {
        return base64_encode($this->getClientId() . ':' . $this->getClientSecret());
    }
}