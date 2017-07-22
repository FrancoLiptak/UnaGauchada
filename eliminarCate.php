<?php

function toIndex() {
    header('Location: index.php');
    die;
}
function toCate() {
    header('Location: categorias.php');
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

if (!isset($_POST['idCategory'])) {
    $_SESSION['msg'] = "No se envio ningun id de categoria a eliminar.";
    toCate();
}

$id = $_POST['idCategory'];
include_once 'fxCategory.php';

if (!validateCate($id)) {
    $_SESSION['msg'] = "El id de categoria ingresado no existe.";
    toCate();
}

deleteCategory($id);
toCate();
die;