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
if (!isset($_POST['idLogros'])) {
    $_SESSION['msg'] = "No se envio ningun id de reputacion.";
    toLogros();
}

$name = trim($_POST['logro']);
$min = trim($_POST['min']);
$id = trim($_POST['idLogros']);
include_once 'fxLogros.php';

if (!validateLogro($id)) {
    $_SESSION['msg'] = "No existe logro con el id enviado.";
    toLogros();
}

if (logroNameExists($id, $name)) {
    $_SESSION['msg'] = "Ya existe otro logro con ese nombre.";
    toLogros();
}
if (logroMinExists($id, $min)) {
    $_SESSION['msg'] = "Ya existe otro logro con ese minimo de reputacion.";
    toLogros();
}

editLogro($id, $name, $min);
toLogros();