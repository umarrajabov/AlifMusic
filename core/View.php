<?php


namespace core;


class View
{
    public static function render($path, $data = [])
    {
        $path = __DIR__ . "/../app/views/{$path}.php";

        include_once $path;
    }
}