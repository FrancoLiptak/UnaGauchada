<?php
include_once 'validate.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!validateLogin()) {
    $_SESSION['msg'] = "No puede ingresar a logout.php si ya tiene una sesion iniciada.";
    header('Location: index.php');
    die;
}

session_start();
session_destroy();
header("Location: index.php");
