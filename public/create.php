<?php

use App\Database;
use App\User;
use App\UserChecker;
use App\Session;

if(!Session::exist('id')) {
    header("Location: signin");
    exit();
}


$title = 'Nový uživatel';
include_once('header.php');

if(isset($_POST['send'])) {
    $user = new User(Database::getInstance());
    $errors = [];
    $userChecker = new UserChecker(Database::getInstance());

    if(!$userChecker->isUsernameValid($_POST['username'])){
        $errors[] = 'Uživatelské jméno není v pořádku.';
    } else {
        if($userChecker->userExists($_POST['username'])) {
            $errors[] = 'Uživaltelské jméno jíž existuje.';
        }
    }

    if (!$userChecker->isPasswordValid($_POST['password'], $_POST['password_verify'])) {
        $errors[] =  'Heslo není v pořádku.';
    }

    if(!$userChecker->isEmailValid($_POST['email'])) {
        $errors[] = 'Emailová adresa není v pořádku.';
    }

    if(empty($errors)) {
        $params = [
            'username' => htmlspecialchars(trim($_POST['username'])),
            'password' => password_hash($_POST['password'], PASSWORD_BCRYPT),
            'email' => htmlspecialchars(trim($_POST['email'])),
        ];

        $user->store($params);
        header("Location: signin");
        exit();
    }


}

?>

    <form id="signup" method="POST" action="">
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
                <label for="password_verify">Kontrolní heslo:</label>
                <input type="password" name="password_verify" id="password_verify">
            </li>
            <li>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email">
            </li>

            <li>
                <input type="submit" name="send" value="Vytvořit">
            </li>
        </ul>

    </form>
<?php if(isset($errors)) : ?>
    <?php foreach ($errors as $error): ?>
        <p class="error"><?= $error ?></p>
    <?php endforeach;?>
<?php endif; ?>

<?php include_once ("footer.php"); ?>