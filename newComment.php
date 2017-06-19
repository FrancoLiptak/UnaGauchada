<?php
session_start();
include_once 'validate.php';
include_once 'fxComments.php';

if (!isset($_POST['idGauchadas'])) {
    $_SESSION['msg'] = "No hay idGauchada para comentar.";
    header('Location: index.php');
    die;
}

$idGauchada = $_POST['idGauchadas'];

if (!(validateLogin())) {
    $_SESSION['msg'] = "No puede comentar si no tiene una sesión iniciada.";
    header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
    die;
}

if (isAdmin()) {
    $_SESSION['msg'] = "No puede comentar si es admin.";
    header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
    die;
}

$idUser = $_SESSION['idUsers'];

if (getOneComment($idGauchada, $idUser)->num_rows > 0) {
    $_SESSION['msg'] = "Ya comentaste en esta gauchada.";
    header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
    die;
}


$comment = null;
if (isset($_POST['comment'])) {
    $comment = $_POST['comment'];
}

newComment($idUser, $idGauchada, $comment);
header('Location: gauchadaVer.php?idGauchadas='.$idGauchada);
die;