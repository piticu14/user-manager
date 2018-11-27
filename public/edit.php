<?php
$title = 'Editace';
include_once('header.php');
?>

    <form method="POST" action="edit">
        <ul class="flex-outer">
            <li>
                <label for="username">Uživatelské jméno:</label>
                <input type="text" name="username" id="username" value="<?= $data['username'] ?>">
            </li>
            <li>
                <label for="password">Heslo:</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= $data['email'] ?>">
            </li>
            <li>
                <input type="hidden" name="id" id="id" value="<?= $data['id'] ?>">
            </li>

            <li>
                <input type="submit" name="send" value="Upravit">
                <a class="back-link" href="users">Zpět</a>
            </li>
        </ul>
    </form>

<?php include_once('footer.php'); ?>