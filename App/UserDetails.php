<?php
/**
 * Created by IntelliJ IDEA.
 * User: pitic
 * Date: 11/26/2018
 * Time: 2:08 PM
 */

namespace App;


class UserDetails
{
    private $database;
    private $table;

    public function __construct(Database $database) {
        $this->database = $database;
        $this->table = 'user_details';
    }

    public function store($params)
    {
        $query = "INSERT INTO " . $this->table . " (user_id, last_activity) VALUES (:user_id, :last_activity)";
        $this->database->execute($query, $params);
    }

    public function findBy($value,$key = 'id') {
        $query = "SELECT * FROM " . $this->table ." WHERE {$key} = :{$key}";
        $params = [$key => $value];
        return $this->database->execute($query, $params)->fetch() ?: null;

    }


    public function patch($params) {

        $query = "UPDATE " . $this->table . " SET  last_activity=:last_activity WHERE id=:id";
        $this->database->execute($query, $params);
    }

    public function destroy($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id=:id";
        $params = compact('id');

        $this->database->execute($query, $params);
    }

    public function all() {
        $query = "SELECT * FROM " . $this->table;
        return $this->database->execute($query)->fetchAll();
    }

    public function lastInsertedId() {
        return $this->database->getLastInsertedId();
    }

}