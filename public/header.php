<?php
use App\User;
use App\Database;

if(isset($_SESSION['id'])) {
    $user = (new User(Database::getInstance()))->findBy($_SESSION['id'], 'id');
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
    <div class="userArea">
        <p>Vitejte, <?= $username?> <a href="logout">Odhlásit</a></p>
    </div>
    <?php endif ?>