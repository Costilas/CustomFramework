<?php

namespace Classes\App;

use Classes\Controllers\Controller;
use Classes\ORM\Orm;
use Classes\Router\Router;
use Classes\Services\Request;
use Classes\View\Presenter;

class App
{
    private Controller $controller;
    private string $controllerMethod;
    private int|null $routeParameter = null;

    public function __construct(protected Orm $orm, protected Request $request, protected Router $router)
    {}

    public function init() {
        try {
            $action = $this->router->defineRouteAction($this->request->getCurrentLocation());
            if(!$action) {throw new \Exception();}
        }catch (\Exception) {
            // log \Exception
            Presenter::render('404/404');
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
    }

    private function setControllerMethod(string $controllerMethodName) {
        $this->controllerMethod = $controllerMethodName;
    }

    private function setController(Controller $controller) {
        $this->controller = $controller;
    }


}