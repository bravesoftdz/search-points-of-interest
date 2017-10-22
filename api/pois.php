<?php

require_once "../vendor/autoload.php";

use Dykyi\Models\Hotels;
use Dykyi\Models\POIs;

/**
 * @param string $name
 * @return string
 */
function getPOIFromHotelName($name, $meters = 1000)
{
    if ($name == ''){
        exit(Hotels::ERROR_INPUT_HOTEL_NAME);
    }

    /** @var Hotels $hotelModel */
    $hotelModel = new Hotels();

    /** @var \Dykyi\Component\Coordinates $coordinates */
    $coordinates = $hotelModel->getHotelCoordinatesByName($name);

    POIs::getPOIsByCoordinates($coordinates, $meters);

    return 0;
}

$post = json_decode($_POST['data']);

echo getPOIFromHotelName($post->data->hotel);