<?php


namespace App\Controllers;

use App\Request;
use App\Session;

class UpdateActivityController extends Controller
{

    public function actionUpdateActivity(Request $request)
    {
        $this->updateActivity();
    }

}