<?php 
include_once "newGauchada.php";

if(newGauchada($_POST['title'], $_POST['description'], $_POST['expiration'], $_POST['category'], $_POST['city'])){
    $_SESSION['msg'] = "La gauchada fue registrada con exito.";
}
else {
    $_SESSION['msg'] = "La gauchada rip.";
}

header("Location: index.php");
die;


?>