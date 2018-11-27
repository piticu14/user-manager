<?php

namespace App\Controllers;

use App\Database;
use App\User;
use App\UserChecker;
use App\UserDetails;
use App\Authenticator;
use App\Session;

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

    public function updateActivity() {
        if (!$this->authenticator->isLoggedIn()) {
            $this->redirect('signin');
        }
        var_dump(Session::get('details_id'));
        die();
        $params = [
            'last_activity' => date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa'))),
            'id' => Session::get('details_id')
        ];
        $this->userDetails->patch($params);
    }

}