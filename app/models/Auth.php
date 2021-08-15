<?php

namespace app\models;

use core\DB;
use security\Validator;

session_start();

class Auth
{
  protected int $id;
  protected string $password;
  protected string $email;
  protected string $username;
  protected string $phone;
  const USER = 2;
  const ADMIN = 1;

  private $dbConn;

  public function __construct()
  {
    $post = $this->getBody();

    if (isset($post)) {
      if (isset($post['password'])) $this->password = $post['password'];
      if (isset($post['email'])) $this->email = $post['email'];
      if (isset($post['username'])) $this->username = $post['username'];
      if (isset($post['phone'])) $this->phone = $post['phone'];
    }
    $this->dbConn = (new DB())->connect();
  }

  public function hashPass($pass)
  {
    $pass = trim($pass);
    return hash('sha256', $pass);
  }

  public function getBody()
  {
    return $_POST ?? null;
  }

  public function subscribe()
  {
    if (isset($_POST['register'])) {
      $validator = new Validator($_POST);
      $errors = $validator->validate(
        ['username', 'username', 'required'],
        ['password', 'password', 'required'],
        ['email', 'email', 'required'],
        ['phone', 'number', 'required']
      );

      if (empty($errors)) {
        $sql = "INSERT INTO `users` (`name`, `email`, `password`, `phone`) VALUES(:name, :email, :password, :phone)";
        $statement = $this->dbConn->prepare($sql);
        $password = $this->hashPass($this->password);
        $statement->bindValue(':name', $this->username);
        $statement->bindValue(':email', $this->email);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':phone', $this->phone);
        if(!$statement->execute()){
          $errors['user'] = "User with this email or phone exsist";
          return $errors;
        }
        $this->id = $this->dbConn->lastInsertId('users');

        $this->insertUserRole();
        $this->saveSession($this->username);
        header('Location: /');
      }

      return $errors;
    }
  }

  public function login()
  {
    if (isset($_POST['login'])) {
      $validator = new Validator($_POST);
      $errors = $validator->validate(
        ['password', 'password', 'required'],
        ['email', 'email', 'required'],
      );

      $pass = $this->hashPass($_POST['password']);
      $email = $_POST['email'];
      if (empty($erros)) {
        $sql = "SELECT name, password, email, role_id, user_id, is_active FROM `users` ";
        $sql .= "INNER JOIN user_has_roles ON users.id = user_has_roles.user_id WHERE email = :email AND password = :password";
        $statement = $this->dbConn->prepare($sql);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $pass);
        $statement->execute();

        $row = $statement->fetch();
        if (empty($row)) {
          $errors['user'] = "User not found";
          return $errors;
        }
        
        if($row['is_active'] == false){
          $errors['user'] = "You are blocked by admins";
          return $errors;
        }
        if ($row['email'] == $email && $row['password'] == $pass) {
          if ($row['role_id'] == self::ADMIN) {
            $this->saveSession($row['name'], self::ADMIN);
            header('Location: http://music.loc/admin');
            return;
          }

          $this->saveSession($row['name']);
          header('Location: http://music.loc/site');
        }
      }
    }
    return $errors;
  }

  public function insertUserRole()
  {
    $sql = "INSERT INTO `user_has_roles`(user_id, role_id) VALUES (:userId, :roleId)";
    $statement = (new DB)->connect()->prepare($sql);
    $statement->bindValue(':userId', $this->id);
    $statement->bindValue(':roleId', self::USER);
    $statement->execute();
  }

  public function saveSession($name, $role = self::USER)
  {
    $_SESSION['name'] = $name;
    $_SESSION['role'] = $role;
    $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
  }

  public function logout()
  {
    session_destroy();
    header('Location: /');
  }
}
