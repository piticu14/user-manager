<?php

namespace App;

class User
{
    private $database;
    private $table;

    public function __construct(Database $database) {
        $this->database = $database;
        $this->table = 'user';
    }

    public function store($params)
    {
        if (isset($_POST['send'])) {
            $query = "INSERT INTO " . $this->table . " (username, password, email) VALUES (:username, :password, :email)";

            $this->database->execute($query, $params);
        }
    }
    public function find($id) {
     $query = "SELECT * FROM " . $this->table ." WHERE id = :id";
     $params = ['id' => $id];

     $this->database->execute($query, $params);
    }

    public function patch($id) {
        $query = "UPDATE " . $this->table . " SET username=':username', password=:password, email=:email, 'updated_at=:updated_at WHERE id=:id";
        $params = [
            'id' => $id,
            'username' => $_POST['username'],
            'password' => password_hash($_POST['password'],PASSWORD_BCRYPT),
            'email' => $_POST['email'],
            'update_at' => date("Y-m-d H:i:s")
        ];

        $this->database->execute($query, $params);
    }

    public function destroy($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id=:id";
        $params = compact('id');

        $this->database->execute($query, $params);
    }

}