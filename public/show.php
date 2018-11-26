<?php

use App\User;
use App\Database;
use App\Session;

if(!Session::exist('id')) {
    header("Location: signin");
    exit();
}

$title = 'Uživatele';

include_once ('header.php');

$database = Database::getInstance();
$users = (new User($database))->all();

?>


<table id="users">
    <thead>
    <tr>
        <th>ID</th>
        <th>Uživatelské jméno</th>
        <th>Email</th>
        <th>Vytvořeno</th>
        <th>Aktualizovano</th>
        <th>Posledně aktivní</th>
    </tr>

    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['id']?></td>
            <td><?= $user['username']?></td>
            <td><?= $user['email']?></td>
            <td><?= $user['created_at']?></td>
            <td><?= $user['updated_at']?></td>
            <td><?= $user['last_activity']?></td>
            <td><a href="edit/<?= $user['id'] ?>">Upravit</a></td>
            <td><a class="delete" href="delete" data-id="<?= $user['id'] ?>">Smazat</a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<div id="new-user">
    <a href="create">Nový uživatel</a>
</div>

<?php include_once('footer.php'); ?>

<script>
    $(document).ready(function() {
        // Pokud je uzivatel online, aktualizuj jeho aktivni cas
        <?php if(Session::exist('id')) :?>
        function update_user_activity() {
            $.post('update-activity');
        }
            setInterval(function() {
                update_user_activity();
            }, 60 * 5 * 1000);

        <?php endif; ?>
    });
</script>
