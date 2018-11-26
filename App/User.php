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
        $query = "INSERT INTO " . $this->table . " (username, password, email) VALUES (:username, :password, :email)";
        $this->database->execute($query, $params);
    }

    public function findBy($value, $key = 'id') {
     $query = "SELECT * FROM " . $this->table ." WHERE {$key} = :{$key}";
     $params = [$key => $value];
     return $this->database->execute($query, $params)->fetch() ?: null;

    }

    public function patch($params) {
        if(array_key_exists('password',$params)) {
            $query = "UPDATE " . $this->table . " SET username=:username, password=:password, email=:email, updated_at=:updated_at WHERE id=:id";
        } else {

            $query = "UPDATE " . $this->table . " SET username=:username, email=:email, updated_at=:updated_at WHERE id=:id";
        }

        $this->database->execute($query, $params);
    }

    public function destroy($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id=:id";
        $params = compact('id');

        $this->database->execute($query, $params);
    }

    public function all() {
        $query = "SELECT user.id,user.username,user.email,user.created_at, user.updated_at, user_details.last_activity 
                  FROM " . $this->table .
                " LEFT JOIN user_details 
                  ON user_details.user_id = user.id";
        return $this->database->execute($query)->fetchAll();
    }

    public function lastInsertedId() {
        $this->database->getLastInsertedId();
    }


}