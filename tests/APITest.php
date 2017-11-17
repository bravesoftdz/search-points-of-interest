<?php

use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;

define('APP_URL', 'http://test.app/api/pois.php');
define('APP_RADIUS', 1);

/**
 * Class APITest
 *
 */
class APITest extends TestCase
{
    public function __construct()
    {
        $dotenv = new \Dotenv\Dotenv(__DIR__ . '/../.env');
        $dotenv->load();
        parent::__construct();
    }

    /**
     * @covers \Dykyi\Config::env()
     */
    public function testEnv()
    {
        $this->assertEquals($_ENV['DB'], 'mysql');
        $this->assertEquals(\Dykyi\Config::env('DB_CONNECTION'), 'mysql');
    }

    public function testApiResponce()
    {
        $hotel    = new \Dykyi\Models\Hotels();
        $client   = new \GuzzleHttp\Client();
        $res      = $client->post(APP_URL,
            ['form_params' => ['hotel' => $hotel->getRandomHotelName(), 'kilometer' => APP_RADIUS]]);
        $response = $res->getBody();

        $this->assertInstanceOf(StreamInterface::class, $response);

        return $response;
    }

    /**
     * @depends testApiResponce
     *
     * @param StreamInterface $response
     */
    public function testApiResponceData(StreamInterface $response)
    {
        $poiList = json_decode($response);
        $this->assertGreaterThan(0, count($poiList));
    }


    public function testApiPrintInfo()
    {
        $this->markTestIncomplete('test private method');
    }

}
