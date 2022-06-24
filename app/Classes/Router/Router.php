<?php

namespace Classes\Router;

class Router
{
    const ROUTES = [
        '/article/{id}' => [\Classes\Controllers\NewsController::class, 'single'],
        '/' => [\Classes\Controllers\NewsController::class, 'index'],
    ];

    const PATTERNS = [
      '{id}' => '(\d+)',
    ];

    private array $decodedPaths = [];

    public function defineRouteAction(string $route):array|bool {
        $this->decodePath();
        return $this->chooseRouteAction($route);
    }

    /*в целом получилось запутанно и можно было бы отойтись if esle с регулярками,
        но хотелось автоматизма
    */
    private function decodePath() {
       $encodedRoutes  = self::ROUTES;
       $decodedRoutes = array_keys($encodedRoutes);
       $actions = array_values($encodedRoutes);
       $patters = self::PATTERNS;

       foreach ($patters as $pattern => $key) {
           $decodedRoutes = array_map(function ($path) use($pattern, $key) {
               $path = preg_replace("/\\//", '\\/', $path);
               return preg_replace("/$pattern/", $key, $path);
           }, $decodedRoutes);
       }
       $this->decodedPaths = array_combine($decodedRoutes, $actions);
    }

    private function chooseRouteAction(string $route):array|bool {
        foreach ($this->decodedPaths as $path => $action)
        {
            if(preg_match("/^$path$/", $route, $match)) {
                return ['action' => $action, 'routeParameter' => $match[1] ?? null];
            }
        }
        return false;
    }
}