<?php

namespace Classes\View;

class Presenter
{
    const RESOURCE =  '/resources/views/';

    static function render(string $template, array $data_arr=[]):void{
        extract($data_arr);

        require dirname('.') . self::RESOURCE . $template . '.php';
    }
}