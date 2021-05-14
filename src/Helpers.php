<?php


namespace EzeepBlueApi;


/**
 * Class Helpers
 * @package EzeepBlueApi
 */
class Helpers
{
    /**
     * @param array $params
     * @return string
     */
    public function queryParams(array $params): string
    {
        return http_build_query($params);
    }

}