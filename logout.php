<?php
include_once 'validate.php';

if (validateLogin()) {
    $_SESSION['msg'] = "No puede ingresar a logout.php si no tiene una sesion iniciada.";
    header('Location: index.php');
    die;
}


    session_start();
    session_destroy();
    header("Location: index.php");
