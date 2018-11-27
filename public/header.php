<?php

use App\Session;
$base = $_SERVER['SCRIPT_NAME'];
$base = str_replace('index.php','',$base);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <base href="<?= $base ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width;initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="container">
    <?php if(Session::exist('username')) :?>
    <div id="userArea">
        <p>
            Vitejte, <a id="welcome" href="edit/<?= Session::get('id')?>"><?= Session::get('username')?></a>

        </p>

        <form id="logout" method="POST" action="logout">
            <input type="submit" value="Odhlásit">
        </form>
    </div>
    <?php endif ?>