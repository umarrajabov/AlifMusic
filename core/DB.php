<?php


namespace core;

use PDO;

require_once __DIR__.'/../config.php';

class DB
{
    public function connect() :PDO
    {
        $pdo = new PDO(DSN, DB_USER, DB_PASSWORD);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $pdo;
    }
}