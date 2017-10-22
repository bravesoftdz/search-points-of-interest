<?php

namespace Dykyi;

use PDO;
use PDOException;
use Exception;

/**
 * Class PDOConnection
 * @package Dykyi
 */
class PDOConnection
{
    /**
     * singleton instance
     *
     * @var PDOConnection
     */
    protected static $_instance = null;

    /**
     * Returns singleton instance of PDOConnection
     *
     * @return PDOConnection
     */
    public static function getInstance()
    {
        if (!self::$_instance) { // If no instance then make one
            new self();
        }
        return self::$_instance;
    }

    /**
     * Create a PDO connection using the dsn and credentials provided
     */
    protected function __construct()
    {
        $db = Config::DataBase();
        try{
            self::$_instance = new PDO(sprintf('mysql:host=%s;dbname=%s', $db->host, $db->name), $db->user, $db->password);
            self::$_instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$_instance->query('SET NAMES utf8');
            self::$_instance->query('SET CHARACTER SET utf8');
        } catch (PDOException $e) {

            //TODO: flag to disable errors?
            throw $e;

        }
        catch(Exception $e) {
            //TODO: flag to disable errors?
            throw $e;
        }
    }

    function __destruct(){}

    /** PHP seems to need these stubbed to ensure true singleton **/
    public function __clone()
    {
        return false;
    }

    public function __wakeup()
    {
        return false;
    }
}