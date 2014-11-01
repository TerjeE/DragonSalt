<?php
session_start();

if (isset($_COOKIE['remember_user'])) {
    unset($_COOKIE['user']);
    setcookie('user', null, -1, '/');
}

session_destroy();
header("Location: login.php");
?>
