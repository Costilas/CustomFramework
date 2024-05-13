<?php

namespace Classes\Utility\Facades\View;

class View
{
    const VIEW_STORAGE =  '/resources/views/';

    static function render(string $template, array $data_arr=[]):void{
        extract($data_arr);

        require dirname('.') . self::VIEW_STORAGE . $template . '.php';
    }
}