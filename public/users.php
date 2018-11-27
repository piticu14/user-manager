<?php
$title = 'Uživatele';
include_once('header.php');
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
    <?php foreach ($data as $user): ?>
        <tr>
            <td><?= $user['id'] ?></td>
            <td><?= $user['username'] ?></td>
            <td><?= $user['email'] ?></td>
            <td><?= $user['created_at'] ?></td>
            <td><?= $user['updated_at'] ?></td>
            <td><?= $user['last_activity'] ?></td>
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

