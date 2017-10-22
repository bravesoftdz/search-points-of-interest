<?php

namespace Dykyi\Models;

use PDO;
use Dykyi\Component\Coordinates;

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
     * @return array|string
     */
    public function getPOIsByCoordinates(Coordinates $coordinates)
    {
        $sqlExample = 'SELECT title FROM pois';
        $stm = self::$db->prepare($sqlExample);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_COLUMN);

        return $data ? $data : '';
    }

}