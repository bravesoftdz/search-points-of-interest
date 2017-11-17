<?php

namespace Dykyi\Models;

use Dykyi\PDOConnection;

/**
 * Class Model
 * @package Dykyi\Component
 */
abstract class BaseModel
{
    /** @var PDOConnection|null  */
    public static $db = null;

    public function __construct()
    {
        self::$db = PDOConnection::getInstance();
    }
}