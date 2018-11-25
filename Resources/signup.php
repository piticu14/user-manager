<?php

if(isset($_POST['send'])) {
    $database = new \App\Database();
    $user = new \App\User($database);

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
    <title>404 - Not found</title>
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

</body>
</html>