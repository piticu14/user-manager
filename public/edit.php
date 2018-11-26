<?php
use App\User;
use App\Database;
use App\UserChecker;
use App\Session;

if(!Session::exist('id')) {
    header("Location: ../signin");
    exit();
}

$title = 'Editace';

include_once ('header.php');

$database = Database::getInstance();
$user = new User($database);

if(isset($_GET['id'])){
    $userData = $user->findBy($_GET['id'],'id');
    if(!$userData) {
        header("Location: ../404.php" );
        exit();
    }
}


if(isset($_POST['send'])) {

    $errors = [];
    $userChecker = new UserChecker(Database::getInstance());
    if(!$userChecker->isUsernameValid($_POST['username'])) {
        $errors[] = 'Vaše uživatelské jméno není v pořádku.';
    } else if (!$userChecker->isEmailValid($_POST['email'])) {
        $errors[] =  'Vaše emailová adresa není v pořádku.';
    } else {
        $params = [
            'id' => $_GET['id'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'updated_at' => date("Y-m-d H:i:s")
        ];

        if(!empty($_POST['password'])) {
            $params['password'] = password_hash($_POST['password'],PASSWORD_BCRYPT);
        }
        $user->patch($params);

        header("Location: ../show");
        exit();
    }
}
?>

    <form method="POST" action="<?php echo htmlentities($_SERVER['REQUEST_URI']) ?>">
        <ul class="flex-outer">
            <li>
                <label for="username">Uživatelské jméno:</label>
                <input type="text" name="username" id="username" value="<?= $userData['username'] ?>">
            </li>
            <li>
                <label for="password">Heslo:</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= $userData['email'] ?>">
            </li>

            <li>
                <input type="submit" name="send" value="Upravit">
                <a class="back-link" href="show">Zpět</a>
            </li>
        </ul>
    </form>
    <?php if(isset($errors)) : ?>
        <?php foreach ($errors as $error): ?>
            <p class="error"><?= $error ?></p>
        <?php endforeach;?>
    <?php endif; ?>

<?php include_once ('footer.php'); ?>