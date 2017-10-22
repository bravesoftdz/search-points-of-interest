<?php

require_once "vendor/autoload.php";

define('URL','http://test.app/api/pois.php');

$app = new \Dykyi\Application();
$app->run(URL);