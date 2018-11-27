<?php

namespace App;

use PDO;
use PDOException;


class Database
{

    private $pdo;
    private static $instance;

    private function __construct()
    {
        include_once __DIR__ . "/config/config.php";
        try {
            $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4;', DB_USERNAME, DB_PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Failed to connect to database: " . $e->getMessage());
        }
    }

    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnect()
    {
        return $this->pdo;
    }

    public function execute($query, $params = NULL)
    {
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);
        return $stmt;
    }

    public function getLastInsertedId()
    {
        return $this->pdo->lastInsertId();
    }

}