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

if (!isset($_POST['cate'])) {
    $_SESSION['msg'] = "No se envio ningun nombre de categoria a editar.";
    toCate();
}
if (!isset($_POST['idCategory'])) {
    $_SESSION['msg'] = "No se envio ningun id de categoria a editar.";
    toCate();
}

$name = trim($_POST['cate']);
$id = trim($_POST['idCategory']);
include_once 'fxCategory.php';

if (!validateCate($id)) {
    $_SESSION['msg'] = "No existe categoria con el id enviado.";
    toCate();
}

if (cateExists($name)) {
    $_SESSION['msg'] = "Ya existe otra categoria con ese nombre.";
    toCate();
}

editCategory($id, $name);
toCate();