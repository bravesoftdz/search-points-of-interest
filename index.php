<?php

require_once "vendor/autoload.php";

define('HOME_FOLDER', __DIR__);
define('APP_URL','http://test.app/api/pois.php');
define('APP_RADIUS', 1);

$dotenv = new \Dotenv\Dotenv(HOME_FOLDER);
$dotenv->load();

$app = new \Dykyi\Application();
$app->run(APP_URL);