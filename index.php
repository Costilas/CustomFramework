<?php

use Classes\App\App;
use Classes\Utility\HttpRequest\Request;
use Classes\Router\Router;

error_reporting(E_ALL);

require_once 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app = new App(new Request(), new Router());
$app->init()->run();