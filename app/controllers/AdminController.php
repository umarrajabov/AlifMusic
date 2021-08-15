<?php

namespace app\controllers;

use app\models\Admin;
use app\models\Albums;
use app\models\Artists;
use app\models\Genres;
use app\models\Music;
use core\View;

class AdminController
{
    public function actionIndex()
    {
        $admin = new Admin();
        $data = $admin->getAll('musics');
        View::render('musicStatistic', $data);
    }

    public function actionMusic()
    {
        $admin = new Admin();
        $authors = $admin->getAll('authors');
        $albums = $admin->getAll('albums');
        $genres = $admin->getAll('genres');
        $errors = (new Music())->save();
        View::render('musicForm', ['authors' => $authors, 'albums' => $albums, 'genres' => $genres, 'errors' => $errors]);
    }

    public function actionArtists()
    {
        $errors = (new Artists())->save();
        View::render('artistsForm', ['errors' => $errors]);
    }

    public function actionAlbums()
    {
        $data = (new Admin())->getAll('authors');
        $errors = (new Albums())->save();
        View::render('albumForm', ['authors' => $data, 'errors' => $errors]);
    }

    public function actionGenres()
    {
        $errors = (new Genres())->save();
        View::render('genreForm', ['errors' => $errors]);
    }

    public function actionDelete()
    {
        $path = explode('/', $_SERVER['REQUEST_URI']);
        $id = $path[3];
        $action = $path[4];
        
        switch ($action) {
            case 'music':
                (new Music)->delete($id);
                break; 
            case 'artists':
                (new Artists)->delete($id);
                break;
            
            case 'users':
                (new Admin)->delete($id);
                break;

            default:
                break;
        }
    }

    public function actionUpdate()
    {
        $path = explode('/', $_SERVER['REQUEST_URI']);
        $id = $path[3];
        $action = $path[4];

        switch ($action) {
            case 'music':
                $admin = new Admin();
                $authors = $admin->getAll('authors');
                $albums = $admin->getAll('albums');
                $genres = $admin->getAll('genres');
                $errors = (new Music())->update($id);
                View::render('musicForm', ['authors' => $authors, 'albums' => $albums, 'genres' => $genres, 'errors' => $errors[1], 'data' => $errors[0]]);
                break;
            case 'artists':
                $data = (new Artists())->update($id);
                View::render('artistsForm', ['data' => $data[0], 'errors' => $data[1]]);
                break;
            case 'albums':
                $authors = (new Admin())->getAll('authors');
                $data = (new Albums())->update($id);
                View::render('albumForm', ['authors' => $authors, 'data' => $data[0], 'errors' => $data[1]]);
                break;
            case 'genres':
                $data = (new Genres())->update($id);
                View::render('genreForm', ['data' => $data[0], 'errors' => $data[1]]);
                break;
            default:
                break;
        }
    }
}
