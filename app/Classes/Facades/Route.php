<?php

namespace Classes\Facades;

use Classes\Router\Router;

class Route
{
    public static function add(string $uri, array $instructions) {
        Router::setRoute($uri, $instructions);
        Router::setActions($instructions);
    }
}