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

if (!isset($_POST['idLogros'])) {
    $_SESSION['msg'] = "No se envio ningun id de logro a eliminar.";
    toLogros();
}

$id = $_POST['idLogros'];
include_once 'fxLogros.php';

if (!validateLogro($id)) {
    $_SESSION['msg'] = "El id de logro ingresado no existe.";
    toLogros();
}
deleteLogro($id);
toLogros();
die;