<?php

namespace App;


class Session
{

    public static function get($name)
    {
        if (self::exist($name)) {
            return $_SESSION[$name];
        }
    }

    public static function exist($name)
    {
        return isset($_SESSION[$name]);
    }

    public static function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function erase($name = null)
    {
        if($name) {
            if (self::exist($name)) {
                unset($_SESSION[$name]);
            }
        } else {
            session_unset();
        }
    }


    public static function destroy()
    {
        self::erase();
        session_destroy();
    }

}