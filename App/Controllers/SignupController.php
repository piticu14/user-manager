<?php
/**
 * Created by IntelliJ IDEA.
 * User: pitic
 * Date: 11/26/2018
 * Time: 10:55 PM
 */

namespace App\Controllers;

use App\Request;
use App\Errors;

class SignupController extends Controller
{

    public function actionSignup(Request $request)
    {
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
                    $this->redirect('signin');
                } else {
                    Errors::set($errors);
                    $this->redirect('signup');
                }
            }
        } else {
            $this->redirect('/errors/500.php', 500);
        }
    }

    public function renderSignup()
    {
        if ($this->authenticator->isLoggedIn()) {
            $this->updateActivity();
            $this->redirect('users');
        }
        $this->render('signup');
        Errors::erase();
    }

}