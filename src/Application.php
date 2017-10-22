<?php

namespace Dykyi;

use Dykyi\Component\Coordinates;
use Dykyi\Helpers\GPSConvertor;
use Dykyi\Models\Hotels;
use Dykyi\Models\POIs;

/**
 * Class Application
 * @package Dykyi
 */
class Application
{
    /**
     * Start function
     *
     * @param $url
     */
    public function run($url)
    {
        $hotel = new Hotels();
        /** @var Coordinates $coord */
        $coord = $hotel->getHotelCoordinatesByName('The Grosvenor Hotel');
        $dd = (new POIs())->getPOIsByCoordinates($coord);
        $rr = GPSConvertor::addMetersToDegreeInLongitude($coord->getLon(),1000);
//        var_dump($rr); die();

        $hotel = (new Hotels())->getRandomHotelName();
        echo Api::connect($url, json_encode(['data' => ['hotel' => $hotel]]));
    }
}
