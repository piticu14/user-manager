<?php

namespace App\Controllers;

use App\Errors;
use App\Request;
use App\Session;

class CreateController extends Controller
{

    public function renderCreate()
    {
        if (!$this->authenticator->isLoggedIn()) {
            Session::destroy();
            $this->redirect('signin');
        } else {
            $this->updateActivity();
            $this->render('create');
            Errors::erase();
        }

    }

    public function actionCreate(Request $request)
    {
        $this->updateActivity();

        $data = $request->getPost();
        if (!empty($data)) {
            if (isset($data['send'])) {
                Errors::erase();
                $errors = [];
                if (!$this->userChecker->isUsernameValid($data['username'])) {
                    $errors[] = 'Uživatelské jméno není v pořádku.';
                } else {
                    if ($this->userChecker->userExists($data['username'])) {
                        $errors[] = 'Uživaltelské jméno jíž existuje.';
                    }
                }
                if (!$this->userChecker->isPasswordValid($data['password'], $data['password_verify'])) {
                    $errors[] = 'Heslo není v pořádku.';
                }
                if (!$this->userChecker->isEmailValid($data['email'])) {
                    $errors[] = 'Emailová adresa není v pořádku.';
                }
                if (empty($errors)) {
                    $params = [
                        'username' => htmlspecialchars(trim($data['username'])),
                        'password' => password_hash($data['password'], PASSWORD_BCRYPT),
                        'email' => htmlspecialchars(trim($data['email'])),
                    ];
                    $this->user->store($params);
                    $this->redirect('users');
                } else {
                    Errors::set($errors);
                    $this->redirect('create');
                }
            }
        } else {
            $this->redirect('/errors/500.php', 500);
        }
    }

}