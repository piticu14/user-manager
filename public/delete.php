<?php
use App\Database;
use App\User;
use App\UserDetails;

if(!isset($_SESSION['id'])) {
    header("Location: signin");
    exit();
}

if($_POST['id'] == $_SESSION['id']) {
    echo "error";
} else {
    $database = Database::getInstance();
    $user = new User($database);
    $userDetails = new UserDetails($database);

    $userData = $user->findBy($_POST['id'], 'id');
    if($userData) {
        $details = $userDetails->findBy($userData['id'], 'user_id');
        if($details) {
            $lastActivityDate = new DateTime($details['last_activity']);
            $now = new \DateTime();
            if($lastActivityDate->diff($now)->s < 10) {
                echo "error";
            } else {
                $user->destroy($_POST['id']);

                echo json_encode($user->all());
            }
        } else {
            $user->destroy($_POST['id']);

            echo json_encode($user->all());
        }

}



}