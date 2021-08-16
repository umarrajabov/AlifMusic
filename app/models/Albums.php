<?php


namespace app\models;


use app\interfaces\Crud;
use core\DB;
use security\Validator;

class Albums implements Crud
{

    private string $name;
    private int $year;
    private int $author;
    private $image;

    /**
     * @return array
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param array $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getYear(): int
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear(int $year): void
    {
        $this->year = $year;
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
        $query = "SELECT * FROM albums WHERE is_active = 1";
        $statement = (new DB())->connect()->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function getById($id)
    {
        $query = "SELECT * FROM `albums` WHERE id = $id";
        $statement = (new DB())->connect()->prepare($query);
        $statement->execute();
        return $statement->fetch();   
    }

    public function delete($id)
    {
        $row = $this->getById($id);
        $bool = filter_var($row['is_active'], FILTER_VALIDATE_BOOLEAN);
        $isActive = $bool ? 0 : 1;

        $query = "UPDATE `albums` SET `is_active` = :isActive WHERE `id` = :id";
        $statement = (new DB)->connect()->prepare($query);
        $statement->bindValue(':id', $id);
        $statement->bindValue(':isActive', (int)$isActive);
        $statement->execute();
        header('Location: http://music.loc/statistics/albums');
    }

    public function save()
    {
        if (isset($_POST['submit'])) {
            $validator = new Validator($_POST, $_FILES);
            $errors = $validator->validate(
                ['name', 'string', 'required'],
                ['year', 'number', 'required'],
                ['image', 'image', 'required']
            );

            
            if (empty($errors)) {
                $this->setValues();
                $sql = "INSERT INTO albums(`name`, `year`, `author_id`)";
                $sql .= " VALUES(:name, :year, :author)";
                $statement = (new DB)->connect()->prepare($sql);
                $statement->bindValue(':name', $this->getName());
                $statement->bindValue(':year', $this->getYear());
                $statement->bindValue(':author', $this->getAuthor());
                $statement->execute();
            }

            return $errors;
        }
    }

    public function update($id)
    {
        $errors = [];

        $sql = "SELECT * from  albums WHERE id = :id";
        $statement = (new DB)->connect()->prepare($sql);
        $statement->bindValue(':id', $id);
        $statement->execute();
        $row = $statement->fetch();

        if (isset($_POST['submit'])) {
            $validator = new Validator($_POST, $_FILES);
            $errors = $validator->validate(
                ['name', 'string', 'required'],
                ['year', 'number', 'required'],
            );

            
            if (!empty($_FILES['image']) && !$_FILES['image']['tmp_name']) {
                $this->setImage($row['photo']);
            }
            
            if (empty($errors)) {
                $this->setValues();
                $sql = "UPDATE `albums` SET name =:name, author_id = :author, ";
                $sql .= "year = :year, photo = :image WHERE id = :id";
                $statement = (new DB)->connect()->prepare($sql);
                $statement->bindValue(':author', $this->getAuthor());
                $statement->bindValue(':name', $this->getName());
                $statement->bindValue(':year', $this->getYear());
                $statement->bindValue(':image', $this->getImage());
                $statement->bindValue(':id', $id);
                $statement->execute();
                header('Location: /statistics/albums');
            }
        }
        return [$row, $errors];
    }

    public function setValues()
    {
        $this->setName($_POST['name']);
        $this->setYear((int)$_POST['year']);
        $this->setAuthor($_POST['author']);
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
