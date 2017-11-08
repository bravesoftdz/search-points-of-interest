<?php

namespace Dykyi;

use Dykyi\Component\Coordinates;
use Dykyi\Models\Hotels;
use GuzzleHttp\Client;
use PHPUnit\Runner\Exception;

/**
 * Class Application
 * @package Dykyi
 */
class Application extends BaseApplication
{
    const ERROR_NOT_POIS_FOUND = 'Not found POIs near Hotel: "%s" in radius: "%skm" ';

    /**
     * @param $hotelName
     * @param array $pois
     * @return string
     */
    private function printInfo($hotelName, array $pois)
    {
        $text = sprintf('The "%s" has %s POIs in a %dkm radius and POIs are:', $hotelName, count($pois), APP_RADIUS) . '<br>';
        foreach ($pois as $i => $one) {
            $text .= sprintf('%d) %s (description: %s, address: %s, lat: %s, lon: %s)',
                    $i + 1,
                    $one->title,
                    '[empty]',
                    is_null($one->address) ? '' : $one->address,
                    is_null($one->lat) ?: $one->lat,
                    is_null($one->lon) ?: $one->lon
                ) . '<br>';
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
        $response = '';
        if (!file_exists(HOME_FOLDER.'/.env')){
            exit('File .env not found!');
        }

        /** @var Coordinates $coord */
        $hotel = (new Hotels())->getRandomHotelName();
        try {
            $this->logger->info('Get POIs from hotel: ' . $hotel);
            $client = new Client();
            $res = $client->post($url, ['form_params' => ['hotel' => $hotel, 'kilometer' => APP_RADIUS]]);
            $response = $res->getBody();
        } catch (Exception $e){
            $this->logger->error($e->getMessage());
        }

        $poiList = json_decode($response);
        if (count($poiList) <= 0)
        {
            $errorMessage = sprintf(self::ERROR_NOT_POIS_FOUND, $hotel, APP_RADIUS);
            $this->logger->info($errorMessage);
            exit($errorMessage);
        }

        echo $this->printInfo($hotel, $poiList);
    }
}
