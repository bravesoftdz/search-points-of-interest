<?php

namespace Dykyi\Component;

/**
 * Class Coordinates
 * @package Dykyi\Component
 */
class Coordinates
{
    /**
     * @var string
     */
    private $lon;

    /**
     * @var string
     */
    private $lat;

    /**
     * Coordinates constructor.
     *
     * @param string $lat
     * @param string $lon
     */
    public function __construct($lat, $lon)
    {
        $this->lat = $lat;
        $this->lon = $lon;
    }

    public function getLon()
    {
        return $this->lon;
    }

    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @return string
     */
    public function toString()
    {
        return $this->lat . ' , ' . $this->lon;
    }
}