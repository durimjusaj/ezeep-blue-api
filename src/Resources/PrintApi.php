<?php

declare(strict_types=1);

namespace EzeepBlueApi\Resources;

use EzeepBlueApi\Client;
use EzeepBlueApi\Enums\Endpoints;

/**
 * Class PrintApi
 * @package EzeepBlueApi\Resources
 */
class PrintApi
{
    /**
     * @var \EzeepBlueApi\Client
     */
    private Client $client;

    /**
     * PrintApi constructor.
     * @param \EzeepBlueApi\Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->client->printClient();
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getConfiguration()
    {
        return $this->client->get(Endpoints::PRINT_GET_CONFIGURATION());
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPrinter()
    {
        return $this->client->get(Endpoints::PRINT_GET_PRINTER());
    }

    /**
     * @param string|null $id
     * @param string|null $printer
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPrinterProperties(string $id = null, string $printer = null)
    {
        return $this->client->get(Endpoints::PRINT_GET_PRINTER_PROPERTIES(), [
            'id' => $id,
            'printer' => $printer
        ]);
    }

    /**
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function prepareUpload()
    {
        return $this->client->get(Endpoints::PRINT_PREPARE_UPLOAD());
    }

    /**
     *
     */
    public function printFileUpload()
    {
        // TODO
    }

    /**
     *
     */
    public function printUploadedFile()
    {
        // TODO
    }


    /**
     * @link https://apidocs.ezeep.com/ezeepblue/README.html#print-a-file-referenced-by-url
     * @param string $fileUrl
     * @param string $type
     * @param string $printerId
     * @param array $options
     *      $options = [
     *          'alias' => (string) Original name of file/document. If it is empty, the fileid will be used.
     *          'printanddelete' => (bool) If true the uploaded document will be deleted after printing. If false the uploaded document remains on the server. Default is false.
     *          'properties' => (array) [
     *              'paper' => (string) Size of the paper. See GetPrinterProperties
     *              'paperid' => (int) Id of of paper size. See GetPrinterProperties
     *              'color' => (bool) Enable color. See GetPrinterProperties
     *              'duplex' => (bool) Enable duplex. See GetPrinterProperties
     *              'duplexmode' => (int) Duplex mode. See GetPrinterProperties
     *              'orientation' => (int) Orientation mode. See GetPrinterProperties
     *              'copies' => (int) Count of copies. See GetPrinterProperties
     *              'resolution' => (string) DPI / quality . See GetPrinterProperties
     *          ]
     *      ]
     * @return string
     */

    public function printUrl(string $fileUrl, string $type, string $printerId, array $options = [])
    {
        $params = array_merge(
            [
                'fileUrl' => $fileUrl,
                'type' => $type,
                'printerid' => $printerId
            ],
            $options
        );
        return $this->client->post(Endpoints::PRINT_PRINT_URL(), $params);
    }

    /**
     * @param string $id
     * @return string
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getStatus(string $id)
    {
        return $this->client->get(Endpoints::PRINT_GET_PRINT_STATUS(), ['id' => $id]);
    }

}