<?php

namespace App\Controllers;
use App\Request;
class LogoutController extends Controller
{

    public function actionLogout(Request $request)
    {
        $this->authenticator->logout();
        $this->redirect('signin');
    }

}