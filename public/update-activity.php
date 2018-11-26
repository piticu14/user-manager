<?php

use App\Database;
use App\UserDetails;
use App\Session;

if (!Session::exist('id')) {
    header("Location: signin");
    exit();
}

$userDetails = new UserDetails(Database::getInstance());
$params = [
    'last_activity' => date("Y-m-d H:i:s", STRTOTIME(date('h:i:sa'))),
    'id' => Session::get('details_id')
];

$userDetails->patch($params);
