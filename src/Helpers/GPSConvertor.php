<?php

namespace Dykyi\Helpers;

/**
 * url: https://v-ipc.ru/guides/coord
 *
 * Class GPSConvertor
 */
class GPSConvertor
{

    const LONGITUDE = 40008.55;
    const LATITUDE  = 40075.696;

    /**
     * @return float
     */
    private static function getLongitudeMeterInSec()
    {
        return round(self::LONGITUDE / 360 / 60 / 60, 3);
    }

    /**
     * @param $degree
     * @return float
     */
    private static function getLatitudeMeterInSec($degree)
    {
        return round((cos($degree) * (self::LATITUDE / 360)) / 60 / 60, 3);
    }

    /**
     * Longitude - it is simple
     *
     * @param $meters
     * @return int
     */
    public static function metersToSecondsLongitude($meters = 1000)
    {
        return round($meters / (self::getLongitudeMeterInSec() * 1000));
    }

    /**
     * @param $degree
     * @param $meters
     * @return int
     */
    private static function metersToSecondsLatitude($degree, $meters)
    {
        return round( $meters / (self::getLatitudeMeterInSec($degree) * 1000));
    }

    /**
     * @param $degree
     * @param int $meters
     * @return array
     */
    public static function addMetersToDegreeInLatitude($degree, $meters = 1000)
    {
        $position = self::metersToSecondsLatitude($degree, $meters) * 0.0001;
        return [$degree + $position, $degree - $position];
    }

    /**
     * @param $degree
     * @param int $meters
     * @return array
     */
    public static function addMetersToDegreeInLongitude($degree, $meters = 1000)
    {
        $position = self::metersToSecondsLongitude($meters) * 0.0001;
        return [$degree + $position, $degree - $position];
    }


}