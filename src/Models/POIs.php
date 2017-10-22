<?php

namespace Dykyi\Models;

use PDO;
use Dykyi\Component\Coordinates;
use Dykyi\Helpers\GPSConvertor;

/**
 * Class POIs
 *
 * @property PDO $db
 *
 * @package Dykyi\Models
 */
class POIs extends BaseModel
{
    const ERROR_INPUT_HOTEL_NAME = 'Please enter the hotel name!';

    /**
     * @param Coordinates $coordinates
     * @param $meters
     * @return array|string
     */
    public static function getPOIsByCoordinates(Coordinates $coordinates, $meters)
    {
        $pair_lot = GPSConvertor::addMetersToDegreeInLongitude($coordinates->getLon(), 1000);
        $pair_lat = GPSConvertor::addMetersToDegreeInLatitude($coordinates->getLat(), $meters);

        $sqlExample = 'SELECT title FROM pois';
        $stm = self::$db->prepare($sqlExample);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_COLUMN);

        return $data ? $data : '';
    }

}