<?php

namespace app\models;

use core\DB;

class Admin
{
  public function check()
  {
    if (!empty($_SESSION) && !$_SESSION['role'] == '1') {
      header('Location: /');
      return false;
    }
    
    return true;
  }
  public function getAll($param)
  {
    if ($this->check()) {
      $query = "SELECT * FROM `${param}` ORDER BY id DESC";
      $stmt = (new DB)->connect()->prepare($query);
      $stmt->execute();
      return $stmt->fetchAll();
    }
  }

  
  public function getById($id)
  {
      $query = "SELECT * FROM `users` WHERE id = $id";
      $statement = (new DB())->connect()->prepare($query);
      $statement->execute();
      return $statement->fetch();   
  }

  public function delete($id)
  {
      $row = $this->getById($id);
      $bool = filter_var($row['is_active'], FILTER_VALIDATE_BOOLEAN);
      $isActive = $bool ? 0 : 1;
      $query = "UPDATE `users` SET `is_active` = :isActive WHERE `id` = :id";
      $statement = (new DB)->connect()->prepare($query);
      $statement->bindValue(':id', $id);
      $statement->bindValue(':isActive', (int)$isActive);
      $statement->execute();
      header('Location: http://music.loc/statistics/users');
  }
}
