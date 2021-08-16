<?php

namespace app\controllers;

use app\models\Genres;
use app\models\Music;
use core\View;

class SiteController
{
    public function actionIndex()
    {
        $genres = (new Genres)->getAll();
        $data = (new Music)->getAll();
        View::render('index', ['musics' => $data, 'genres' => $genres]);
    }
    
    public function actionRegister()
    {
        View::render('register');
    }
}
