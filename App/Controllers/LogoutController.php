<?php

namespace App\Controllers;

class LogoutController extends Controller
{

    public function actionLogout($request)
    {
        $this->authenticator->logout();
        $this->redirect('signin');
    }

}