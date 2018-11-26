<?php
use App\Database;
use App\User;
use App\UserDetails;
use App\Session;

if(!Session::exist('id')) {
    header("Location: signin");
    exit();
}

if($_POST['id'] == Session::get('id')) {
    echo "error";
} else {
    $database = Database::getInstance();
    $user = new User($database);
    $userDetails = new UserDetails($database);

    $userData = $user->findBy($_POST['id'], 'id');
    if($userData) {
        $details = $userDetails->findBy($userData['id'], 'user_id');
        // Pokud uzivatel byl prihlaseni alespon jednou
        if($details) {
            $lastActivityDate = new DateTime($details['last_activity']);
            $now = new \DateTime();
            // Pokud doba aktivity neni delsi 8 minut, uzivatel nejde odstranit
            if($lastActivityDate->diff($now)->i < 8) {
                echo "error";
            } else {
                $user->destroy($_POST['id']);

                echo json_encode($user->all());
            }
            // Uzivate nebyl prihlasn ani jednou. Muzeme ho odstranit.
        } else {
            $user->destroy($_POST['id']);
            echo json_encode($user->all());
        }

}



}