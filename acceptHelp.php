<?php
session_start();
include_once 'validate.php';
include_once 'fxHelp.php';
include_once 'credits.php';
include_once 'fxMail.php';

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
if (acceptHelp($idGauchada, $idUser)) {
    $gauchada = getOneGauchada($idGauchada);
    $user = getUser($idUser)->fetch_assoc();
    $owner = getUser($gauchada['idUser'])->fetch_assoc();

    sendMail($user, $owner, $gauchada);
}
header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
die;
