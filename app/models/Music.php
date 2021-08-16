<?php

namespace app\models;

use app\interfaces\Crud;
use core\DB;
use security\Validator;

class Music implements Crud
{
    private string $title;
    private string $src;
    private $image;
    private int $genre;
    private int $album;
    private int $author;
    private string $length;
    private int $id;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getSrc(): string
    {
        return $this->src;
    }

    /**
     * @param string $src
     */
    public function setSrc(string $src): void
    {
        $this->src = $src;
    }

    /**
     * @return
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getGenre(): int
    {
        return $this->genre;
    }

    /**
     * @param int $genre
     */
    public function setGenre(int $genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @return int
     */
    public function getAlbum(): int
    {
        return $this->album;
    }

    /**
     * @param int $album
     */
    public function setAlbum(int $album): void
    {
        $this->album = $album;
    }

    /**
     * @return int
     */
    public function getAuthor(): int
    {
        return $this->author;
    }

    /**
     * @param int $author
     */
    public function setAuthor(int $author): void
    {
        $this->author = $author;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $author
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLength(): string
    {
        return $this->length;
    }

    /**
     * @param string $length
     */
    public function setLength(string $length): void
    {
        $this->length = $length;
    }

    public function getAll(): array
    {
        $query = "SELECT * FROM `musics` INNER JOIN authors a on musics.author_id = a.id WHERE `musics`.is_active = 1 AND `a`.is_active = 1 ORDER BY created_at DESC";
        $statement = (new DB())->connect()->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getByGenres($id): array
    {
        $query = "SELECT * FROM `genres` INNER JOIN musics on `genres`.id = `musics`.genre_id WHERE `musics`.is_active = 1 GROUP BY `genres`.id ORDER BY created_at DESC";
        $statement = (new DB())->connect()->prepare($query);
        if(!$statement->execute()){
            return ['Errrrror'];
        }
        return $statement->fetchAll();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM `musics` WHERE id = $id";
        $statement = (new DB())->connect()->prepare($query);
        $statement->execute();
        return $statement->fetch();   
    }

    public function delete($id)
    {
        $row = $this->getById($id);
        $bool = filter_var($row['is_active'], FILTER_VALIDATE_BOOLEAN);
        $isActive = $bool ? 0 : 1;
        $this->setId($id);
        $query = "UPDATE `musics` SET `is_active` = :isActive WHERE `id` = :id";
        $statement = (new DB)->connect()->prepare($query);
        $statement->bindValue(':id', $this->getId());
        $statement->bindValue(':isActive', (int)$isActive);
        $statement->execute();
        header('Location: http://music.loc/admin');
    }

    public function update($id)
    {
        $errors = [];

        $sql = "SELECT * from  musics WHERE id = :id";
        $statement = (new DB)->connect()->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $row = $statement->fetch();

        if (isset($_POST['submit'])) {
            $validator = new Validator($_POST, $_FILES);
            $errors = $validator->validate(
                ['title', 'string', 'required'],
                ['image', 'image'],
            );

            
            if (!empty($_FILES['image']) && !$_FILES['image']['tmp_name']) {
                $this->setImage($row['music_image']);
            }   
            
            if (!empty($_FILES['music']) && !$_FILES['music']['tmp_name']) {
                $this->setSrc($row['src']);
            }
            
            if (empty($errors)) {
                $this->setValues();
                $sql = "UPDATE `musics` SET title =:title, album_id = :album, ";
                $sql .= "genre_id = :genre, author_id = :author, src = :src, music_image = :image WHERE id = :id";
                $statement = (new DB)->connect()->prepare($sql);
                $statement->bindValue(':title', $this->getTitle());
                $statement->bindValue(':album', $this->getAlbum());
                $statement->bindValue(':genre', $this->getGenre());
                $statement->bindValue(':author', $this->getAuthor());
                $statement->bindValue(':src', $this->getSrc());
                $statement->bindValue(':image', $this->getImage());
                $statement->bindValue(':id', $id);
                $statement->execute();
                header('Location: /admin/index');
            }
        }
        return [$row, $errors];
    }

    public function save()
    {
        if (isset($_POST['submit'])) {
            $validator = new Validator($_POST, $_FILES);
            $errors = $validator->validate(
                ['title', 'string', 'required'],
                ['image', 'image', 'required'],
                ['music', 'music', 'required'],
            );

            
            if (empty($errors)) {
                $this->setValues();
                $sql = "INSERT INTO musics(`title`, `album_id`, `genre_id`, `author_id`, `src`, `length`,`music_image`)";
                $sql .= " VALUES(:title, :album, :genre, :author, :src, :length, :image)";
                $statement = (new DB)->connect()->prepare($sql);
                $statement->bindValue(':title', $this->getTitle());
                $statement->bindValue(':album', $this->getAlbum());
                $statement->bindValue(':genre', $this->getGenre());
                $statement->bindValue(':author', $this->getAuthor());
                $statement->bindValue(':src', $this->getSrc());
                $statement->bindValue(':length', $this->getLength());
                $statement->bindValue(':image', $this->getImage());
                $statement->execute();
                header('Location: http://music.loc/admin/index');
            }
            return $errors;
        }
    }

    public function setValues()
    {
        $this->setTitle($_POST['title']);
        $this->setAlbum($_POST['album']);
        $this->setGenre($_POST['genre']);
        $this->setAuthor($_POST['author']);
        $this->setLength($_POST['length']);
        $this->setSrc($_FILES['music']['name']);
        $this->setImageFile();

        if (isset($_FILES['music']) && $_FILES['music']['tmp_name']) {
            if (!file_exists(__DIR__ . "/../../music")) {
                mkdir(__DIR__ . "/../../music");
            }
            $targetDir = __DIR__ . "/../../music/";
            $targetFile = $targetDir . md5(rand(1, 100)) . basename($_FILES["music"]["name"]);
            move_uploaded_file($_FILES['music']['tmp_name'], $targetFile);
            $targetFile = explode('/', $targetFile);
            $targetFile = $targetFile[3] . '/' . $targetFile[4];
            $this->setSrc($targetFile);
        }
    }

    public function setImageFile()
    {
        if (isset($_FILES['image']) && $_FILES['image']['tmp_name']) {
            if (!file_exists(__DIR__ . "/../../images")) {
                mkdir(__DIR__ . "/../../images");
            }
            $targetDir = __DIR__ . "/../../images/";
            $targetFile = $targetDir . md5(rand(1, 100)) . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
            $targetFile = explode('/', $targetFile);
            $targetFile = '/' . $targetFile[3] . '/' . $targetFile[4];
            $this->setImage($targetFile);
        }
    }
}
