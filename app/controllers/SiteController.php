<?php

namespace app\controllers;

use app\models\Admin;
use app\models\Music;
use core\View;

class SiteController
{
    public function actionIndex()
    {
        $genres = (new Admin)->getAll('genres');
        $data = (new Music)->getAll();
        View::render('index', ['musics' => $data, 'genres' => $genres]);
    }
    
    public function actionRegister()
    {
        View::render('register');
    }
}
