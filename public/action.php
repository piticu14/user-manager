<?php

use App\Database;
use App\UserDetails;

if(!isset($_SESSION['id'])) {
    header("Location: signin");
    exit();
}

if(isset($_POST['action'])) {

    if($_POST['action'] === 'update_time') {


    $userDetails = new UserDetails(Database::getInstance());
    $params = [
        'last_activity'  => date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa'))),
        'id' => $_SESSION['details_id']
    ];

    $userDetails->patch($params);
    }
}
