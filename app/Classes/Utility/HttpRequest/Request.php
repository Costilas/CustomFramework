<?php

namespace Classes\Utility\HttpRequest;

class Request
{
    private string $currentLocation;
    private array $currentRequest;

    public function __construct()
    {
        $this->currentLocation = $this->setCurrentLocation();
        $this->currentRequest = $this->setCurrentRequest();
    }

    public function getCurrentLocation():string {
        return $this->currentLocation;
    }

    public function getCurrentRequest():array {
        return $this->currentRequest;
    }

    public function get(string $parameter) {
        $currentRequest = $this->getCurrentRequest();
        return $currentRequest[$parameter] ?? null;
    }

    private function setCurrentLocation() {
        return strtok($_SERVER['REQUEST_URI'], '?');
    }

    private function setCurrentRequest() {
        return $_REQUEST;
    }
}