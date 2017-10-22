<?php

namespace Dykyi\Helpers;

/**
 * url: https://v-ipc.ru/guides/coord
 *
 * Class GPSConvertor
 */
class GPSConvertor
{

    const LATITUDE = 40008.55;

    public static function getLongitudeMeterInSec()
    {
        return round(self::LATITUDE / 360 / 60 / 60, 3);
    }

    /**
     * Longitude - it is simple
     *
     * @param $degree
     * @param $meters
     * @return int
     */
    public static function addMetersToDegreeLongitude($degree, $meters)
    {
        return 1;
    }

    /**
     * @param $degree
     * @param $meters
     * @return int
     */
    public static function addMetersToDegreeLatitude($degree, $meters)
    {
        return 1;
    }



}