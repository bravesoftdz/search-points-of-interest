<?php

namespace Dykyi\Models;

use PDO;

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

    /**]
     * @return array|string
     */
    public function getPOIsByCoordinates()
    {
        $sqlExample = 'SELECT * FROM pois WHERE (lat IS NOT NULL) AND (lon IS NOT NULL)';
        $stm = self::$db->prepare($sqlExample);
        $stm->execute();
        $data = $stm->fetchAll(PDO::FETCH_OBJ);

        return $data ? $data : '';
    }

}