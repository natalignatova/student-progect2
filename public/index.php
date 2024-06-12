<?php
session_start();

require_once __DIR__ . '/../vendor/autoload.php';

$request = new \Ig\Lg\Core\Request();
$config = __DIR__ . '/../config.json';

$app = new \Ig\Lg\Core\Application($config);
$response = $app->handleRequest($request);
$response->send();
