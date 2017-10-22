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
//        $dd = (new POIs())->getPOIsByCoordinates($coord);
//        $rr = GPSConvertor::getLongitudeMeterInSec($coord->getLon());
//      1) визначити довжину для градуса + і -
//      2) визначити ширину по формулі для + і -
//      3) додати їх до градусів 
//      4) знайти дані двома бетвінами в функцію, яку передаєш лише готель і кілометраж

        var_dump($rr); die();
        var_dump($dd); die();


        $hotel = (new Hotels())->getRandomHotelName();
        echo Api::connect($url, json_encode(['data' => ['hotel' => $hotel]]));
    }
}
