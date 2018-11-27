<?php
$title = 'Přihlašování';
include_once('header.php');
?>

    <form method="POST" action="signin">
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

<?php include_once('footer.php'); ?>