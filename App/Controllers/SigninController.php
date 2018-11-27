<?php

namespace App\Controllers;

use App\Errors;
use App\Request;

class SigninController extends Controller
{

    public function actionSignin(Request $request)
    {
        Errors::erase();
        $errors = [];
        $data = $request->getPost();
        if ($data) {
            if (!$this->userChecker->isUsernameValid($data['username'])) {
                $errors[] = 'Uživatelské jméno není v pořádku.';
            }
            if (!$this->userChecker->isPasswordValid($data['password'])) {
                $errors[] = 'Heslo není v pořádku.';
            }
            if (empty($errors)) {
                $username = trim($data['username']);
                $password = trim($data['password']);

                if ($this->authenticator->authenticate(array($username, $password))) {
                    $this->redirect('users');

                } else {
                    $errors[] = 'Přihlašování se nepovedlo.';
                }
            } else {
                Errors::set($errors);
                $this->redirect('signin');
            }
        } else {
            $this->redirect('/errors/500.php', 500);
        }
    }

    public function renderSignin()
    {
        if ($this->authenticator->isLoggedIn()) {
            $this->redirect('users');
        }
        $this->render('signin');
        Errors::erase();
    }

}