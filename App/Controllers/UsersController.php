<?php

namespace App\Controllers;


class UsersController extends Controller
{

    public function renderUsers()
    {
        $this->updateActivity();
        if (!$this->authenticator->isLoggedIn()) {
            $this->redirect('signin');
        }
        $users = $this->user->all();
        $this->render('users', $users);
    }

}