<?php

namespace Dykyi;

use Dykyi\Component\Coordinates;
use Dykyi\Models\Hotels;

/**
 * Class Application
 * @package Dykyi
 */
class Application
{

    const RADIUS = 1;

    /**
     * @param $hotelName
     * @param array $pois
     * @return string
     */
    private function printInfo($hotelName, array $pois)
    {
        $text = sprintf('The "%s" has %s POIs in a %dkm radius and POIs are:', $hotelName, count($pois), self::RADIUS). '<br>';
        foreach ($pois as $i => $one){
            $text .= sprintf('%d) %s (description: %s, address: %s, lat: %s, lon: %s)',
                    $i+1,
                    $one->title,
                    '[empty]',
                    is_null($one->address) ? '' : $one->address,
                    is_null($one->lat) ?: $one->lat,
                    is_null($one->lon) ?: $one->lon
                    ) .'<br>';
        }
        return $text;
    }


    /**
     * Start function
     *
     * @param $url
     */
    public function run($url)
    {
        /** @var Coordinates $coord */
        $hotel = (new Hotels())->getRandomHotelName();
        $jsonPOIlist = Api::connect($url, json_encode([
            'data' => [
                'hotel'     => $hotel,
                'kilometer' => self::RADIUS,
            ],
        ]));
        $poiList = json_decode($jsonPOIlist);
        if (count($poiList) <= 0)
        {
            exit(Hotels::ERROR_NOT_POIS_FOUND);
        }

        echo $this->printInfo($hotel, $poiList);
    }
}
