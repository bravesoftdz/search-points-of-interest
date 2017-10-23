<?php

require_once "../vendor/autoload.php";

use Dykyi\Models\Hotels;
use Dykyi\Models\POIs;
use Dykyi\Component\Coordinates;
use Dykyi\Helpers\GPSConvertor;

/**
 * @param $name
 * @param int $kilometer
 * @return array
 */
function getPOIFromHotelName($name, $kilometer = 1)
{
    if ($name === ''){
        json_encode(['error' => Hotels::ERROR_INPUT_HOTEL_NAME]);
        exit;
    }

    /** @var Hotels $hotelModel */
    $hotelModel = new Hotels();

    /** @var \Dykyi\Component\Coordinates $coordinates */
    $coordinates = $hotelModel->getHotelCoordinatesByName($name);

    /** @var POIs $poisModel */
    $poisModel = new POIs();
    $poiList = $poisModel->getPOIsByCoordinates();

    $result = [];
    foreach ($poiList as $poi){
        if (GPSConvertor::getDistance($coordinates, new Coordinates($poi->lat, $poi->lon)) < $kilometer){
            $result[] = $poi;
        }
    }

    return $result;
}

$post = json_decode($_POST['data']);
echo json_encode(getPOIFromHotelName($post->data->hotel, $post->data->kilometer));
