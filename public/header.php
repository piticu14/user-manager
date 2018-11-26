<?php
use App\User;
use App\Database;
use App\Session;

if(Session::exist('id')) {
    $user = (new User(Database::getInstance()))->findBy(Session::get('id'), 'id');
    if($user) {
        $username = $user['username'];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <base href="http://localhost/user-manager/public/" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width;initial-scale=1">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="container">
    <?php if(isset($username)) :?>
    <div id="userArea">
        <p>
            Vitejte, <a id="welcome" href="edit/<?= Session::get('id')?>"><?= $username?></a>

        </p>
        <p>
            <a href="logout">Odhlásit</a>
        </p>
    </div>
    <?php endif ?>