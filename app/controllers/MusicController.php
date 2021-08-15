<?php

namespace app\controllers;

use app\models\Admin;
use app\models\Albums;
use app\models\Artists;
use app\models\Music;
use core\View;

class MusicController
{
    public function actionIndex()
    {
        $genres = (new Admin)->getAll('genres');
        $data = (new Music)->getAll();
        View::render('index', ['musics' => $data, 'genres' => $genres]);
    }

    public function actionArtists()
    {
        $test = new Artists();
        $data = $test->getAll();
        View::render('artists', $data);
    }

    public function actionAlbums()
    {
        $test = new Albums();
        $data = $test->getAll();
        View::render('albums', $data);
    }

    public function actionGenres()
    {
        View::render('getByGenres');
    }

    public function actionSearch()
    {
        View::render('search');
    }
}

