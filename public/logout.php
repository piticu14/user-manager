<?php
if (isset($_SESSION['id'])) {
    session_unset();
    session_destroy();
}
header("Location: signin");
