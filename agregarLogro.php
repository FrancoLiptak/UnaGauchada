<?php

function toIndex() {
    header('Location: index.php');
    die;
}
function toLogros() {
    header('Location: logros.php');
    die;
}

include_once 'validate.php';

if (!validateLogin()) {
    $_SESSION['msg'] = "Debe estar logueado para realizar esta acción.";
    toIndex();
}

if (!isAdmin()) {
    $_SESSION['msg'] = "Solo los administradores pueden realizar esta accion.";
    toIndex();
}

if (!isset($_POST['logro'])) {
    $_SESSION['msg'] = "No se envio ningun nombre de logro.";
    toLogros();
}

if (!isset($_POST['min'])) {
    $_SESSION['msg'] = "No se envio ningun minimo de reputacion.";
    toLogros();
}

$name = trim($_POST['logro']);
$min = trim($_POST['min']);
include_once 'fxLogros.php';

if (logroNameExistsNoId($name)) {
    $_SESSION['msg'] = "El nombre de logro ingresado ya esta en uso.";
    toLogros();
}
if (logroMinExistsNoId($min)) {
    $_SESSION['msg'] = "El minimo de reputacion ingresado ya esta en uso.";
    toLogros();
}

newLogro($name, $min);
toLogros();