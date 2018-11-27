<?php
/**
 * Created by IntelliJ IDEA.
 * User: pitic
 * Date: 11/26/2018
 * Time: 9:33 PM
 */

namespace App;


class Errors
{

    public static function get()
    {
        return Session::get('errors');
    }

    public static function set($errors)
    {
        Session::erase('errors');
        Session::set('errors', $errors);
    }

    public static function erase()
    {
        Session::erase('errors');
    }

    public static function exist()
    {
        return Session::exist('errors');
    }

}
