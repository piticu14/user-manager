<?php

namespace App\Controllers;

use App\Session;
class UsersController extends Controller
{

    public function renderUsers()
    {
        if (!$this->authenticator->isLoggedIn()) {
            Session::destroy();
            $this->redirect('signin');
        }
        $this->updateActivity();
        $users = $this->user->all();
        $this->render('users', $users);
    }

}