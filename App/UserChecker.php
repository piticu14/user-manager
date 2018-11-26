<?php
/**
 * Created by IntelliJ IDEA.
 * User: pitic
 * Date: 11/26/2018
 * Time: 1:29 AM
 */

namespace App;

class UserChecker
{
    private $database;

    public function __construct(Database $database){
        $this->database = $database;
    }

    public function isUsernameValid($username) {
        $username = trim($username);
        $passed = true;
        if(empty($username)) {
            $passed = false;
        } else if (strlen($username) < 4 || strlen($username) > 50) {
            $passed = false;
        }
        return $passed;
    }

    public function userExists($username) {
        $query = "SELECT username FROM user WHERE username=:username";
        $params = compact('username');
        $result = $this->database->execute($query, $params);
        if($result->rowCount() === 0) {
            return false;
        }

        return true;
    }

    public function isEmailValid($email) {
        $email = trim($email);
        $passed = true;
        if(empty($email)) {
            $passed = false;
        }else if(filter_input(FILTER_VALIDATE_EMAIL, $email)) {
            $passed = false;
        }else if (strlen($email) > 255) {
            $passed = false;
        }

        return $passed;
    }

    public function isPasswordValid($password, $verify_password = null) {
        $password = trim($password);
        $verify_password = trim($verify_password);
        $passed = true;

        if(empty($password)) {
            $passed =  false;
        } else if ($verify_password && $password !== $verify_password) {
            $passed =  false;
        }
        return $passed;
    }

}