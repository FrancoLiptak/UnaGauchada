<?php
session_start();
include_once 'validate.php';
include_once 'fxHelp.php';

if (!isset($_POST['idGauchadas'])) {
    $_SESSION['msg'] = "No hay idGauchada para hacer help.";
    header('Location: index.php');
    die;
}

$idGauchada = $_POST['idGauchadas'];

if (!(validateLogin())) {
    $_SESSION['msg'] = "No puede cancelar ayudas si no tiene una sesion iniciada.";
    header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
    die;
}

if (isAdmin()) {
    $_SESSION['msg'] = "No puede cancelar ayudas si es admin.";
    header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
    die;
}

$idUser = $_SESSION['idUsers'];

deleteHelp($idGauchada, $idUser);
header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
die;
