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
    $_SESSION['msg'] = "No se envio ningun nombre de categoria a crear.";
    toCate();
}

$name = trim($_POST['cate']);
include_once 'fxCategory.php';

if (cateExists($name)) {
    $cate = cateByName($name);
    $_SESSION['msg'] = "El nombre de categoria ingresado ya esta en uso.";
    if ($cate['deleted']) {
        $_SESSION['msg'] = $_SESSION['msg']." Estaba eliminada y fue reactivada.";
        activateCate($cate['idCategory']);
    }
    toCate();
}

newCategory($name);
toCate();