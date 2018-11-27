<?php

namespace App;


class Authenticator
{

    private $userDetails;
    private $user;

    public function __construct(User $user, UserDetails $userDetails)
    {
        $this->user = $user;
        $this->userDetails = $userDetails;
    }

    public function authenticate($credentials)
    {
        if ($this->checkCredentials($credentials)) {
            list($username, $password) = $credentials;
            $user = $this->user->findBy($username, 'username');
            Session::set('id', $user['id']);
            Session::set('username', $user['username']);
            $this->addUserDetails($user['id']);

            return true;
        } else {
            return false;
        }
    }

    private function addUserDetails($userId)
    {
        $params = [
            'user_id' => $userId,
            'last_activity' => date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')))
        ];
        $userDetails = $this->userDetails->findBy($userId, 'user_id');
        if ($userDetails) {
            Session::set('details_id', $userDetails['id']);
        } else {
            $this->userDetails->store($params);
            Session::set('details_id', $this->userDetails->lastInsertedId());
        }
    }

    private function checkCredentials($credentials)
    {
        list($username, $password) = $credentials;
        $user = $this->user->findBy($username, 'username');
        if ($user) {
            if (password_verify($password, $user['password'])) {
                return true;
            }
        }
        return false;
    }

    public function isLoggedIn()
    {
        if (Session::exist('id')) {
            $user = $this->user->findBy(Session::get('id'), 'id');
            if ($user) return true;
            return false;
        }
        return false;
    }

    public function logout()
    {
        if (Session::exist('id')) {
            session_unset();
            session_destroy();
        }
    }

}