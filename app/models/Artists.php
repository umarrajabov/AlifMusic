<?php

namespace app\models;

use app\interfaces\Crud;
use core\DB;
use security\Validator;

class Artists implements Crud
{
    private $name;
    private $bio;
    private $image;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * @param mixed $bio
     */
    public function setBio($bio): void
    {
        $this->bio = $bio;
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

    public function getAll(): array
    {
        $query = "SELECT COUNT(musics.id) AS 'songs', authors.name, authors.avatar, authors.is_active FROM musics RIGHT JOIN authors ";
        $query .= "ON musics.author_id = authors.id WHERE authors.is_active = 1 GROUP BY authors.id ORDER BY name";
        $statement = (new DB())->connect()->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM `authors` WHERE id = $id";
        $statement = (new DB())->connect()->prepare($query);
        $statement->execute();
        return $statement->fetch();   
    }

    public function delete($id)
    {
        $row = $this->getById($id);
        $bool = filter_var($row['is_active'], FILTER_VALIDATE_BOOLEAN);
        $isActive = $bool ? 0 : 1;
        $query = "UPDATE `authors` SET `is_active` = :isActive WHERE `id` = :id";
        $statement = (new DB)->connect()->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':isActive', (int)$isActive);
        $statement->execute();
        header('Location: http://music.loc/statistics/artists');
    }

    public function update($id)
    {
        $errors = [];

        $sql = "SELECT * from `authors` WHERE id = :id";
        $statement = (new DB)->connect()->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $row = $statement->fetch();

        if (isset($_POST['submit'])) {
            $validator = new Validator($_POST);
            $errors = $validator->validate(
                ['name', 'string', 'required'],
            );

            
            if (!empty($_FILES['image']) && !$_FILES['image']['tmp_name']) {
                $this->setImage($row['avatar']);
            }
            
            if (empty($errors)) {
                $this->setValues();
                $sql = "UPDATE `authors` SET name =:name, bio = :bio, ";
                $sql .= " avatar = :image WHERE id = :id";
                $statement = (new DB)->connect()->prepare($sql);
                $statement->bindValue(':name', $this->getName());
                $statement->bindValue(':bio', $this->getBio());
                $statement->bindValue(':image', $this->getImage());
                $statement->bindValue(':id', $id);
                $statement->execute();
                header('Location: /statistics/artists');
            }
        }
        return [$row, $errors];
    }

    public function save()
    {
        if (isset($_POST['submit'])) {
            $validator = new Validator($_POST);
            $errors = $validator->validate(
                ['name', 'string', 'required'],
                ['image', 'image', 'required'],
            );

            
            if (empty($errors)) {
                $this->setValues();
                $sql = "INSERT INTO `authors`(`name`, `bio`, `avatar`)";
                $sql .= " VALUES(:name, :bio, :image)";
                $statement = (new DB)->connect()->prepare($sql);
                $statement->bindValue(':name', $this->getName());
                $statement->bindValue(':bio', $this->getBio());
                $statement->bindValue(':image', $this->getImage());
                $statement->execute();
            }
            return $errors;
        }
    }

    public function setValues()
    {
        $this->setName($_POST['name']);
        $this->setBio($_POST['bio']);
        $this->setImageFile();
        
    }

    private function setImageFile()
    {
        if (isset($_FILES['image']) && $_FILES['image']['tmp_name']) {
            if (!file_exists(__DIR__."/../../images")) {
                mkdir(__DIR__."/../../images");
            }
            $targetDir = __DIR__."/../../images/";
            $targetFile = $targetDir . md5(rand(1,100)) . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES['image']['tmp_name'], $targetFile);
            $targetFile = explode('/', $targetFile);
            $targetFile = '/'. $targetFile[3] . '/' . $targetFile[4]; 
            $this->setImage($targetFile);
        }
    }
}
