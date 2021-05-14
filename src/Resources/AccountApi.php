<?php

declare(strict_types=1);

namespace EzeepBlueApi\Resources;

use EzeepBlueApi\Client;

/**
 * Class AccountApi
 * @package EzeepBlueApi\Resources
 */
class AccountApi
{
    /**
     * @var \EzeepBlueApi\Client
     */
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
        $this->client->accountClient();
    }
}