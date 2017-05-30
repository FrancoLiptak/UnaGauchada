<?php
include_once "loginFx.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

userLogin($_POST['email'], $_POST['pass']);

if (isset($_SESSION['idUsers'])) {
    header("Location: index.php");
} else {
    header("Location: logIn.php");
}
