<?php


namespace core;

use Error;
use ErrorException;

class Application
{
    /**
     *
     * @throws ErrorException
     */

    public static function run()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $pathParts = explode('/', $path);

        $controller = (empty($pathParts[1])) ? 'site' : $pathParts[1];
        $action = (empty($pathParts[2])) ? 'index' : $pathParts[2];

        $controller = "app\\controllers\\" . ucfirst($controller) . 'Controller';
        $action = "action" . ucfirst($action);
        $action = explode('?', $action);
        $action = $action[0];

        if (!class_exists($controller)){
            View::render('_404');
            http_response_code(404);
            return;
        }

        $objController = new $controller;

        if (!method_exists($objController, $action)){
            View::render('_404');
            http_response_code(404);
            return;
        }

        call_user_func_array([$objController, $action], $_GET);
    }
}