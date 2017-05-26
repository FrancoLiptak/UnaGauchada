<?php

session_start();
include_once 'validate.php';
include_once 'gauchadasFx.php';

$idGauchada = $_GET['idGauchadas'];

if (validate($idGauchada)  ) {
    showOneGauchada(getOneGauchada($idGauchada));
}
else {
    $_SESSION['msg'] = "No selecciono ninguna gauchada.";
    header('Location: index.php');
    die;
}

?>