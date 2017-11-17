<?php

use PHPUnit\Framework\TestCase;
use PHPUnit\DbUnit\TestCaseTrait;

/**
 * Class DBTest
 */
class DBTest extends TestCase
{
    use TestCaseTrait;

    /**
     * only instantiate pdo once for test clean-up/fixture load
     *
     * @var null
     */
    static private $pdo = null;

    /**
     * only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
     *
     * @var null
     */
    private $conn = null;

    protected function setUp()
    {
        if (!extension_loaded('mysqli')) {
            $this->markTestSkipped('The MySQLi extension is not available.');
        }
    }

    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo === null) {
                self::$pdo = new PDO($GLOBALS['DB_DSN'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, $GLOBALS['DB_DBNAME']);
        }

        return $this->conn;
//        $pdo = new PDO('sqlite::memory:');
//        return $this->createDefaultDBConnection($pdo, ':memory:');
    }

    /**
     * @return \PHPUnit\DbUnit\DataSet\FlatXmlDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(__DIR__ . '/../database/hotels.xml');
    }

    public function testCreateQueryTable()
    {
        $queryTable    = $this->getConnection()->createDataSet(['hotels'])->getTable('hotels')->getRowCount();
        $expectedTable = $this->getDataSet()->getTable('hotels')->getRowCount();
        $this->assertEquals($expectedTable, $queryTable);
    }

    public function testTableCountHotels()
    {
        $dataSet = $this->getConnection()->createDataSet(['hotels']);
        $queryTable = $dataSet->getTable('hotels');
        $this->assertGreaterThan(0, $queryTable->getRowCount());
        $this->assertArraySubset(['id','title','address','lat','lon'], $queryTable->getTableMetaData()->getColumns());
    }

    public function testTableCountPOIs()
    {
        $dataSet = $this->getConnection()->createDataSet(['pois']);
        $queryTable = $dataSet->getTable('pois');
        $this->assertGreaterThan(0, $queryTable->getRowCount());
        $this->assertArraySubset(['id','title','address','lat','lon',], $queryTable->getTableMetaData()->getColumns());
    }

    /**
     * Stop here and mark this test as incomplete.
     */
    public function testConnection()
    {
        $this->markTestIncomplete('This test has not been implemented yet.');
    }
}
