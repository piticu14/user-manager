<?php

namespace App;

use PDO;
use PDOException;


class Database
{
    private $pdo;

    public function connect() {
        if(!$this->pdo) {
            include_once  __DIR__ . "/config/config.php";
            try {
                $this->pdo = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME . ';charset=utf8mb4;', DB_USERNAME, DB_PASSWORD);
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e){
                die("Failed to connect to database: " . $e->getMessage());
            }
        }
    }

    public function execute($query, $params = NULL) {
        if(!$this->pdo) {
            $this->connect();
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }


}