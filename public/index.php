<?php

require_once(__DIR__ . "/../vendor/autoload.php");

if (isset($_GET['page']) && ($_GET['page'] === 'index.php')) {
    include_once __DIR__ . '/signup.php';

} else {
    session_start();
    $resource = __DIR__ . '/' . $_GET['page'] . '.php';

    if(file_exists($resource)) {
        include_once $resource;
    } else {
        include_once __DIR__ . '/errors/404.php';
        die();
    }
}
