<?php

require_once(__DIR__ . "/../vendor/autoload.php");

use App\Request;

session_start();
$request = new Request();

$request->process($_GET['page']);