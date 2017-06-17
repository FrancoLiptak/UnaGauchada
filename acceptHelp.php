<?php
session_start();
include_once 'validate.php';
include_once 'fxHelp.php';

if (!isset($_POST['idGauchadas'])) {
    $_SESSION['msg'] = "No hay idGauchada para aceptar help.";
    header('Location: index.php');
    die;
}

$idGauchada = $_POST['idGauchadas'];

if (!isset($_POST['idUsers'])) {
    $_SESSION['msg'] = "No hay idUsers para aceptar help.";
    header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
    die;
}

$idUser = $_POST['idUsers'];

acceptHelp($idGauchada, $idUser);
header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
die;
