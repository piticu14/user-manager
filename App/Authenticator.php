<?php

namespace App;

use DateTime;

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
            Session::erase();
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
        Session::erase('details_id');

        $userDetails = $this->userDetails->findBy($userId, 'user_id');
        if ($userDetails) {
            $params = [
                'id' => $userDetails['id'],
                'last_activity' => date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')))
            ];
            Session::set('details_id', $userDetails['id']);
            $this->userDetails->patch($params);
        } else {
            $params = [
                'user_id' => $userId,
                'last_activity' => date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa')))
            ];
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
        $loggedIn = false;
        if (Session::exist('details_id')) {
            $userDetails = $this->userDetails->findBy(Session::get('details_id'));
                $userLastActivity = new DateTime($userDetails['last_activity']);
                if(time() - $userLastActivity->getTimestamp() < 1800) {
                    $loggedIn = true;
                }
        }
        return $loggedIn;
    }

    public function logout()
    {
        if (Session::exist('id')) {
           Session::destroy();
        }
    }

}