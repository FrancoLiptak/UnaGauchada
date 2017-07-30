<?php

include_once 'header.php';
include_once 'alert.php';
include_once 'gauchadasFx.php';
include("footer.html");

?> 
    <br><br><br><br> 
<?php

if(deleteGauchada($_GET["id"])){
    hacerAlert("La gauchada se ha eliminado con éxito.", "success");
}else{
    hacerAlert("La gauchada no pudo ser eliminada. Por favor, intente mas tarde.");

}

echo "<center><a type='button' class='btn btn-default btn-filter' href='index.php'>Volver al inicio</a></center>";


?>

