<?php


namespace EzeepBlueApi\Enums;

use MyCLabs\Enum\Enum;

final class Endpoints extends Enum
{
    private const OAUTH_AUTHORIZE = 'oauth/authorize';
    private const OAUTH_ACCESS_TOKEN = 'oauth/access_token/';

    private const PRINT_GET_CONFIGURATION = 'sfapi/GetConfiguration/';
    private const PRINT_GET_PRINTER = 'sfapi/GetPrinter/';
    private const PRINT_GET_PRINTER_PROPERTIES = 'sfapi/GetPrinterProperties/';

    private const PRINT_PREPARE_UPLOAD = 'sfapi/PrepareUpload/';

    private const PRINT_PRINT_URL = 'sfapi/Print/';
    private const PRINT_GET_PRINT_STATUS = 'sfapi/Status/';

}