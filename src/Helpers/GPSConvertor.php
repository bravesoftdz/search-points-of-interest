<?php

namespace Dykyi\Helpers;

use Dykyi\Component\Coordinates;

/**
 * url: https://v-ipc.ru/guides/coord
 *
 * Class GPSConvertor
 */
class GPSConvertor
{

    const LONGITUDE = 40008.55;
    const LATITUDE  = 40075.696;

    /**
     * TODO: For large data, it's better to move the implementation inside SQL query
     * 
     * @param Coordinates $coord1
     * @param Coordinates $coord2
     * @return int
     */
    public static function getDistance(Coordinates $coord1, Coordinates $coord2 ) {
        $earth_radius = 6371;

        $dLat = deg2rad( $coord2->getLat() - $coord1->getLat() );
        $dLon = deg2rad( $coord2->getLon() - $coord1->getLon() );

        $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($coord1->getLat())) * cos(deg2rad($coord2->getLat())) * sin($dLon/2) * sin($dLon/2);
        $c = 2 * asin(sqrt($a));
        return $earth_radius * $c;
    }


    /**
     * @param $dec
     * @return array
     */
    public static function DECtoDMS($dec)
    {

        // Converts decimal longitude / latitude to DMS
        // ( Degrees / minutes / seconds )

        // This is the piece of code which may appear to
        // be inefficient, but to avoid issues with floating
        // point math we extract the integer part and the float
        // part by using a string function.

        $vars = explode(".",$dec);
        $deg = $vars[0];
        $tempma = "0.".$vars[1];

        $tempma = $tempma * 3600;
        $min = floor($tempma / 60);
        $sec = $tempma - ($min*60);

        return array("deg"=>$deg,"min"=>$min,"sec"=>$sec);
    }

    /**
     * @param $deg
     * @param $min
     * @param $sec
     * @return int
     */
    public static function DMStoDEC($deg,$min,$sec)
    {
        // Converts DMS ( Degrees / minutes / seconds )
        // to decimal format longitude / latitude
        return $deg+((($min*60)+($sec))/3600);
    }


}
