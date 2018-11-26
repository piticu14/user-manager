<?php
/**
 * Created by IntelliJ IDEA.
 * User: pitic
 * Date: 11/26/2018
 * Time: 7:44 PM
 */

namespace App;


class Session
{

    public static function get($name) {
        return $_SESSION[$name];
    }

    public static function exist($name) {
        return isset($_SESSION[$name]);
    }

    public static function set($name, $value) {
        $_SESSION[$name] = $value;
    }

}