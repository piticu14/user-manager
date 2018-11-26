<?php

use App\User;
use App\Database;

if(!isset($_SESSION['id'])) {
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

<?php include_once('footer.php'); ?>

<script>
    $(document).ready(function() {
        <?php if(isset($_SESSION['id'])) :?>
        function update_user_activity() {
            var action = 'update_time';
            $.post('action', {action: action}, function(data, status){

            });
        }
            setInterval(function() {
                update_user_activity();
            }, 50000);

        <?php else: ?>
        function fetch_user_login_data() {
            var var_action = "fetch_data";
            $.post('action', {action: action}, function(data, status){

            });
        }
        <?php endif;?>
    });
</script>
