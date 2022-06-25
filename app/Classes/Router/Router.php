<?php

namespace Classes\Router;

class Router
{
    const ROUTES_STORAGE_PATH = './routes/routes.php';
    const PATTERNS = [
      '{id}' => '(\d+)',
    ];
    private static array $encodedRoutes = [];
    private array $decodedRoutes = [];

    public function __construct()
    {
        $this->getRoutes();
        $this->decodeRoutes();
    }

    public function defineRouteAction(string $route):array|bool {
        return $this->chooseRouteAction($route);
    }

    private function decodeRoutes() {
       $patterns = self::PATTERNS;
       $decodedRoutes = array_keys(self::$encodedRoutes);
       $actions = array_values(self::$encodedRoutes);

       foreach ($patterns as $pattern => $key) {
           $decodedRoutes = array_map(function ($path) use($pattern, $key) {
               $path = str_replace('/',"\\/", $path);
               return str_replace("$pattern", $key, $path);
           }, $decodedRoutes);
       }

       $this->decodedRoutes = array_combine($decodedRoutes, $actions);
    }

    private function chooseRouteAction(string $route):array|bool {
        foreach ($this->decodedRoutes as $routePattern => $action)
        {
            if(preg_match("/^$routePattern$/", $route, $match)) {
                return ['action' => $action, 'routeParameter' => $match[1] ?? null];
            }
        }
        return false;
    }

    private function getRoutes()
    {
        require_once self::ROUTES_STORAGE_PATH;
    }

    public static function setRoute(string $path, array $instructions) {
        self::$encodedRoutes[$path] = $instructions;
    }
}