<?php

use PHPUnit\Framework\TestCase;
use Dykyi\Helpers\GPSConvertor;

/**
 * Class HelpersTest
 *
 * @coversDefaultClass GPSConvertor
 */
class HelpersTest extends TestCase
{
    /**
     * @coversNothing
     */
    public function testDistanceCalculate()
    {
        $cord1 = new \Dykyi\Component\Coordinates(1,2);
        $cord2 = new \Dykyi\Component\Coordinates(3,4);
        $gps = GPSConvertor::getDistance($cord1, $cord2);
        $this->assertNotEmpty($gps);
    }

}
