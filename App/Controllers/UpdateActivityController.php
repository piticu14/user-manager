<?php


namespace App\Controllers;

use App\Request;
use App\Session;

class UpdateActivityController extends Controller
{

    public function actionUpdateActivity(Request $request)
    {
        if (!$this->authenticator->isLoggedIn()) {
            $this->redirect('signin');
        }
        $params = [
            'last_activity' => date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa'))),
            'id' => Session::get('details_id')
        ];
        $this->userDetails->patch($params);
    }

}