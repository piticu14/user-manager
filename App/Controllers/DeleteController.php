<?php

namespace App\Controllers;

use App\Request;
use App\Session;
use DateTime;

class DeleteController extends Controller
{

    public function actionDelete(Request $request)
    {

        if (!$this->authenticator->isLoggedIn()) {
            Session::destroy();
            $this->redirect('signin');
        }

        $this->updateActivity();

        $data = $request->getPost();
        if ($data) {
            if ($data['id'] == Session::get('id')) {
                echo "error";
            } else {
                $userData = $this->user->findBy($data['id'], 'id');
                if ($userData) {
                    $details = $this->userDetails->findBy($userData['id'], 'user_id');
                    // Uzivatel byl prihlaseni alespon jednou
                    if ($details) {
                        $lastActivityDate = new DateTime($details['last_activity']);
                        $now = new \DateTime();
                        // Doba aktivity neni delsi 8 minut, uzivatel nejde odstranit
                        if ($lastActivityDate->diff($now)->i < 8) {
                            echo "error";
                        } else {
                            $this->user->destroy($data['id']);
                            echo json_encode($this->user->all());
                        }
                        // Uzivate nebyl prihlasen ani jednou. Muzeme ho odstranit.
                    } else {
                        $this->user->destroy($data['id']);
                        echo json_encode($this->user->all());
                    }
                }
            }
        } else {
            $this->redirect('/errors/500.php', 500);
        }
    }

}