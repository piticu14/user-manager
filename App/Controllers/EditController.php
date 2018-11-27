<?php

namespace App\Controllers;


use App\Errors;
use App\Request;
use App\Session;

class EditController extends Controller
{

    public function renderEdit($id = null)
    {

        if ($id) {
            if (!$this->authenticator->isLoggedIn()) {
                Session::destroy();
                $this->redirect('signin');
            }
            $this->updateActivity();
            if (isset($id)) {
                $userData = $this->user->findBy($id, 'id');
                if ($userData) {
                    $this->render('edit', $userData);
                    Errors::erase();
                } else {
                    $this->redirect('../errors/500.php');
                }
            }
        } else {
            $this->redirect('../errors/500.php');
        }
    }

    public function actionEdit(Request $request)
    {
        $this->updateActivity();

        if (!$this->authenticator->isLoggedIn()) {
            Session::destroy();
            $this->redirect('signin');
        }
        Errors::erase();
        $data = $request->getPost();
        if ($data) {
            if (isset($data['send'])) {
                $errors = [];
                if (!$this->userChecker->isUsernameValid($data['username'])) {
                    $errors[] = 'Vaše uživatelské jméno není v pořádku.';
                }
                if (!$this->userChecker->isEmailValid($data['email'])) {
                    $errors[] = 'Vaše emailová adresa není v pořádku.';
                }
                $params = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'updated_at' => date("Y-m-d H:i:s")
                ];
                if (!empty($data['password'])) {
                    $params['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
                }
                if (empty($errors)) {
                    $this->user->patch($params);
                    $this->redirect('users');
                } else {
                    Errors::set($errors);
                    $this->redirect("edit/{$data['id']}");
                }
            }
        } else {
            $this->redirect('../errors/500', 500);
        }
    }

}