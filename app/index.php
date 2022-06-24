<?php

use Classes\App\App;
use Classes\Services\Request;
use Classes\Router\Router;
use Classes\ORM\Orm;

error_reporting(E_ALL);

require_once 'autoload.php';
require 'vendor/autoload.php';

$app = new App(new Orm(), new Request(), new Router());
$app->init()->run();