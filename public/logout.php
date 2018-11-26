<?php
use App\Session;
if (Session::exist('id')) {
    session_unset();
    session_destroy();
}
header("Location: signin");
