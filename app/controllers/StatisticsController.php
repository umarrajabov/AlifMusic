<?php

namespace app\controllers;

use app\models\Admin;
use core\View;

class StatisticsController {

    public function actionIndex()
    {
        $this->actionMusics();
    }

    public function actionMusics()
    {
        $admin = new Admin();
        $data = $admin->getAll('musics');
        View::render('musicStatistic', $data);
    }

    public function actionAlbums()
    {
        $admin = new Admin();
        $data = $admin->getAll('albums');
        View::render('albumsStatistic', $data);
    }

    public function actionArtists()
    {
        $admin = new Admin();
        $data = $admin->getAll('authors');
        View::render('artistsStatistic', $data);
    }

    public function actionGenres()
    {
        $admin = new Admin();
        $data = $admin->getAll('genres');
        View::render('genresStatistic', $data);
    }

    public function actionUsers()
    {
        $admin = new Admin();
        $data = $admin->getAll('users');
        View::render('usersStatistic', $data);
    }

}