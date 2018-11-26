<?php

include_once(__DIR__ . '/../vendor/autoload.php');

use App\Database;
use App\User;

if(isset($_POST['send'])) {
    $user = new User(Database::getInstance());

    $params = [
        'username' => $_POST['username'],
        'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
        'email' => $_POST['email']
    ];

    $user->store($params);

}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrace</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width;initial-scale=1">
</head>
<body>
<div style="margin:0 auto">
    <form method="POST" action="">
        <div>
            <label for="username">Uživatelské jméno:</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">Heslo:</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email">
        </div>

        <div>
            <input type="submit" name="send" value="Vytvořit">
        </div>
    </form>
</div>
<p><a href="signin.php">Přihlásit se</a></p>

</body>
</html>