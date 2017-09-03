<?php
session_start();
include_once 'validate.php';
include_once 'fxHelp.php';

if (!isset($_POST['idGauchadas'])) {
    $_SESSION['msg'] = "No hay gauchada para ayudar.";
    header('Location: index.php');
    die;
}

$idGauchada = $_POST['idGauchadas'];

if (!(validateLogin())) {
    $_SESSION['msg'] = "No puede ayudar si no tiene una sesion iniciada.";
    header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
    die;
}

if (isAdmin()) {
    $_SESSION['msg'] = "No puede ayudar si es admin.";
    header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
    die;
}

$idUser = $_SESSION['idUsers'];

if (getOneHelp($idGauchada, $idUser)->num_rows > 0) {
    $_SESSION['msg'] = "Ya ayudaste en esa gauchada.";
    header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
    die;
}


$description = null;
if (isset($_POST['description'])) {
    $description = $_POST['description'];
}

newHelp($idUser, $idGauchada, $description);
header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
die;
