<?php
namespace app\controllers;

use core\View;
use app\models\Auth;

class UserController {

    public function actionLogin()
    {
        $login = new Auth();
        $data = $login->login();
        View::render('login', $data);
    } 
    
    public function actionRegister()
    {
        $register = new Auth();
        $data = $register->subscribe();
        View::render('register', $data);
    }

    public function actionLogout()
    {
        (new Auth)->logout();
    }
}