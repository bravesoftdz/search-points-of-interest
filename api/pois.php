<?php

require_once "../vendor/autoload.php";

use Dykyi\Models\Hotels;

/**
 * @param string $name
 * @return string
 */
function getPOIFromHotelName($name)
{
    if ($name == ''){
        exit(Hotels::ERROR_INPUT_HOTEL_NAME);
    }

    /** @var Hotels $hotelModel */
    $hotelModel = new Hotels();

    /** @var \Dykyi\Component\Coordinates $coordinates */
    $coordinates = $hotelModel->getHotelCoordinatesByName($name);

    return $coordinates->toString();
}

$post = json_decode($_POST['data']);

echo getPOIFromHotelName($post->data->hotel);