<?php
session_start();
include_once 'fxScore.php';

if (!isset($_POST['idGauchadas'])) {
    $_SESSION['msg'] = "No hay idGauchada para dar score.";
    header('Location: index.php');
    die;
}
$idGauchada = $_POST['idGauchadas'];

if (hasScore($idGauchada)) {
    $_SESSION['msg'] = "La gauchada ya fue puntuada.";
    header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
    die;
}

if (!isset($_POST['idUser'])) {
    $_SESSION['msg'] = "No hay idUser para dar score.";
    header('Location: index.php');
    die;
}
$idUser = $_POST['idUser'];

if (!isset($_POST['score'])) {
    $_SESSION['msg'] = "No hay puntaje para dar score.";
    header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
    die;
}
$score = $_POST['score'];
switch ($score) {
    case '0':
        $rep = -2;
        $creds = 0;
        break;
    case '1':
        $rep = 0;
        $creds = 0;
        break;
    case '2':
        $rep = 1;
        $creds = 1;
        break;
}

$description = "";
if (isset($_POST['description'])) {
    $description = $_POST['description'];
}

if (newScore($idGauchada, $rep, $description)) {
    updateRep($idUser, $rep, $creds);
}

header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
die;
