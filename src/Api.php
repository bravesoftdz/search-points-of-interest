<?php

namespace Dykyi;

/**
 * Class Api
 * @package Dykyi
 */
class Api
{
    /**
     * @param string $url
     * @param $data
     * @return mixed
     */
    static function connect($url, $data)
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ['data' => $data]);

        // receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec ($ch);

        curl_close ($ch);

        return $server_output;
    }
}