<?php

namespace Dykyi\Models;

use PDO;
use Dykyi\Component\Coordinates;

/**
 * Class Hotels
 *
 * @property PDO $db
 *
 * @package Dykyi\Models
 */
class Hotels extends BaseModel
{
    const ERROR_INPUT_HOTEL_NAME = 'Please enter the hotel name!';

    /**
     * @return string
     */
    public function getRandomHotelName()
    {
        $sqlExample = 'SELECT title FROM hotels ORDER BY RAND() LIMIT 1';
        $stm = self::$db->prepare($sqlExample);
        $stm->execute();
        $data = $stm->fetch(PDO::FETCH_COLUMN);

        return $data ? $data : '';
    }

    /**
     * @param $name
     * @return mixed|string
     */
    public function getHotelCoordinatesByName($name)
    {
        $sqlExample = 'SELECT lat, lon FROM hotels WHERE title = :hotel_name';
        $stm = self::$db->prepare($sqlExample);
        $stm->bindParam(":hotel_name", $name);
        $stm->execute();
        $data = $stm->fetch(PDO::FETCH_OBJ);

        return $data ? new Coordinates($data->lat, $data->lon) : null;
    }
}