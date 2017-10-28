<?php

namespace Dykyi;

use stdClass;

/**
 * Class Config
 * @package Dykyi
 */
class Config
{
    /**
     * @param $key
     * @return array
     */
    public static function env($key)
    {
        return isset($_ENV[$key]) ? $_ENV[$key] : [];
    }

    /**
     * @return stdClass
     */
    public static function DataBase()
    {
        $params = new stdClass();
        $params->host = self::env('DB_HOST');
        $params->name = self::env('DB_DATABASE');
        $params->user = self::env('DB_USERNAME');
        $params->password = self::env('DB_PASSWORD');

        return $params;
    }

}