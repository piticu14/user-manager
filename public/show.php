<?php

include_once(__DIR__ . '/../../vendor/autoload.php');
use App\User;
use App\Database;

$database = Database::getInstance();
$users = (new User($database))->all();

?>


<!DOCTYPE html>
<html>
<head>
    <title>Uživatele</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width;initial-scale=1">
</head>
<body>
<div style="margin:0 auto">
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Created At</th>
            <th>Updated At</th>
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
                <td><a href="./edit.php/?id=<?= $user['id'] ?>">Upravit</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>

    </table>
</div>

</body>
</html>
