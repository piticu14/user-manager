<?php
$title = 'Nový uživatel';
include_once('header.php');
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
                <a class="back-link" href="users">Zpět</a>
            </li>
        </ul>
    </form>

<?php include_once('footer.php'); ?>