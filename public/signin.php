<?php

use App\Database;
use App\Authenticator;
use App\UserChecker;
use App\User;
use App\UserDetails;

$title = 'Přihlašování';
include_once ('header.php');

if(isset($_SESSION['id'])) {
    $user = (new User(Database::getInstance()))->findBy($_SESSION['id'], 'id');
    if($user) {
        header("Location: show");
        exit();
    }
}

if(isset($_POST['send'])) {
    $errors = [];
    $userChecker = new UserChecker(Database::getInstance());

    if(!$userChecker->isUsernameValid($_POST['username'])){
        $errors[] = 'Uživatelské jméno není v pořádku.';
    }

    if (!$userChecker->isPasswordValid($_POST['password'])) {
        $errors[] =  'Heslo není v pořádku.';
    }
    if(empty($errors)) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $database = Database::getInstance();
        $user = new User($database);
        $userDetails = new UserDetails($database);
        $authentication = new Authenticator($user, $userDetails);

        if(!$authentication->authenticate(array($username, $password))) {
            $errors[] = 'Přihlašování se nepovedlo.';
        }else {
                header("Location: show");
                exit();
            }
        }

    }

    ?>

    <form method="POST" action="">
        <ul class="flex-outer">
            <li>
                <label for="username">Uživatelské jméno:</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Heslo:</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <input type="submit" name="send" value="Přihlásit">
            </li>
        </ul>

    </form>
    <p><a href="signup">Zaregistrovat se</a></p>
    <?php if(isset($errors)) : ?>
        <?php foreach ($errors as $error): ?>
            <p class="error"><?= $error ?></p>
        <?php endforeach;?>
    <?php endif; ?>

    <?php include_once ('footer.php'); ?>