<?php

namespace EzeepBlueApi\Enums;

use MyCLabs\Enum\Enum;

class HttpMethod extends Enum
{
    public const GET = 'GET';
    public const POST = 'POST';
    public const DELETE = 'DELETE';
    public const PUT = 'PUT';
}