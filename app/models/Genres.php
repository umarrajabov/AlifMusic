<?php

namespace app\models;

use app\interfaces\Crud;
use core\DB;
use security\Validator;

class Genres implements Crud
{
    private string $genre;
    private ?string $description;

    /**
     * @return string
     */
    public function getGenre(): string
    {
        return $this->genre;
    }

    /**
     * @param string $genre
     */
    public function setGenre(string $genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @return ?string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param ?string $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getAll()
    {
        $query = "SELECT * FROM `genres` ORDER BY id DESC";
        $stmt = (new DB)->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    public function save()
    {
        if (isset($_POST['submit'])) {
            $validator = new Validator($_POST);
            $errors = $validator->validate(
                ['genre', 'string', 'required'],
            );

            $this->setValues();
            if (empty($errors)) {
                $sql = "INSERT INTO genres(`genre`, `description`)";
                $sql .= " VALUES(:genre, :description)";
                $statement = (new DB)->connect()->prepare($sql);
                $statement->bindValue(':genre', $this->getGenre());
                $statement->bindValue(':description', $this->getDescription());
                if(!$statement->execute()){
                    echo "error";
                }
            }
            return $errors;
        }
    }

    public function delete($id)
    {
        // TODO: Implement delete() method.
    }

    public function update($id)
    {
        $errors = [];

        $sql = "SELECT * from genres WHERE id = :id";
        $statement = (new DB)->connect()->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $row = $statement->fetch();

        if (isset($_POST['submit'])) {
            $validator = new Validator($_POST);
            $errors = $validator->validate(
                ['genre', 'string', 'required'],
            );

            $this->setValues();

            if (empty($errors)) {
                $sql = "UPDATE `genres` SET genre = :genre, description = :description ";
                $sql .= " WHERE id = :id";
                $statement = (new DB)->connect()->prepare($sql);
                $statement->bindValue(':description', $this->getDescription());
                $statement->bindValue(':genre', $this->getGenre());
                $statement->bindValue(':id', $id);
                $statement->execute();
                header('Location: /statistics/genres');
            }
        }
        return [$row, $errors];
    }

    public function setValues()
    {
        $this->setGenre($_POST['genre']);
        $this->setDescription($_POST['description']);
    }
}