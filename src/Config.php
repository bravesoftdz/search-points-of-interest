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
     * @return stdClass
     */
    public static function DataBase()
    {
        $params = new stdClass();
        $params->host = 'localhost';
        $params->name = 'homestead';
        $params->user = 'homestead';
        $params->password = 'secret';

        return $params;
    }

}