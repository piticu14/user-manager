<?php
/**
 * Created by IntelliJ IDEA.
 * User: pitic
 * Date: 11/25/2018
 * Time: 8:58 PM
 */

namespace App;


class Authentication
{

    public function __construct(Database $database) {
        $this->database = $database;
    }

    public function login($credentials) {
        list ($username, $password) = $credentials;
    }
}