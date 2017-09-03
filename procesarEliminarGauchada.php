<?php

include_once 'alert.php';
include_once 'gauchadasFx.php';
include("footer.html");

if(deleteGauchada($_GET["id"])){
    $_SESSION['success'] = "La gauchada se ha eliminado con éxito.";
}else{
    $_SESSION['msg'] = "La gauchada no pudo ser eliminada. Por favor, intente mas tarde.";

}

header('Location: index.php');


/*

echo "<br><br><br><br><br>";

if(deleteGauchada($_GET["id"])){
    hacerAlert("La gauchada se ha eliminado con éxito.", "success");
}else{
    hacerAlert("La gauchada no pudo ser eliminada. Por favor, intente mas tarde.");

}

echo "<center><a type='button' class='btn btn-default btn-filter' href='index.php'>Volver al inicio</a></center>";

*/

?>

