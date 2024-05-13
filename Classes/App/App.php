<?php

namespace Classes\App;

use Classes\Container\Container;
use Classes\Controllers\Controller;
use Classes\Router\Router;
use Classes\Utility\Facades\View\View;
use Classes\Utility\HttpRequest\Request;

class App
{
    private Controller $controller;
    private string $controllerMethod;
    private int|null $routeParameter = null;

    static Container $container;

    public function __construct(protected Request $request, protected Router $router)
    {
        static::$container = new Container();
    }

    public function init() {
        try {
            $action = $this->router->defineRouteAction($this->request->getCurrentLocation());
            if(!$action) {throw new \Exception();}
        }catch (\Exception) {
            // log \Exception
            View::render('404/404');
            die();
        }

        $this->setController($this->defineController($action['action'][0]));
        $this->setControllerMethod($action['action'][1]);
        $this->routeParameter = $action['routeParameter'];

        return $this;
    }

    public function run() {
        $method = $this->controllerMethod;
        $this->controller->$method($this->request, $this->routeParameter);
    }

    private function defineController(string $controllerClassName) {
        return new $controllerClassName();
        //return static::$container->get($controllerClassName);
    }

    private function setControllerMethod(string $controllerMethodName) {
        $this->controllerMethod = $controllerMethodName;
    }

    private function setController(Controller $controller) {
        $this->controller = $controller;
    }


}