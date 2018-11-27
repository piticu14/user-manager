<?php
/**
 * Created by IntelliJ IDEA.
 * User: pitic
 * Date: 11/26/2018
 * Time: 10:49 PM
 */

namespace App\Controllers;

use App\Database;
use App\User;
use App\UserChecker;
use App\UserDetails;
use App\Authenticator;

class Controller
{

    protected $user;
    protected $userChecker;
    protected $userDetails;
    protected $database;
    protected $authenticator;

    public function __construct()
    {
        $this->database = Database::getInstance();
        $this->user = new User($this->database);
        $this->userChecker = new UserChecker($this->database);
        $this->userDetails = new UserDetails($this->database);
        $this->authenticator = new Authenticator($this->user, $this->userDetails);

    }

    public function redirect($path, $code = 404)
    {
        header("Location: {$path}");
        exit($code);
    }

    public function render($page, $data = null)
    {
        if (isset($page) && ($page === 'index.php')) {
            include_once dirname(dirname(__DIR__)) . '/public/signup.php';
        } else {
            $resource = dirname(dirname(__DIR__)) . '/public/' . $page . '.php';

            if (file_exists($resource)) {
                include_once $resource;
            } else {
                include_once dirname(dirname(__DIR__)) . '/public/errors/404.php';
                die();
            }
        }
    }

}