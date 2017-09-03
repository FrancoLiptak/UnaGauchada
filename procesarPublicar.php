<?php 
include_once "newGauchada.php";

if(newGauchada($_POST['title'], $_POST['description'], $_POST['expiration'], $_POST['category'], $_POST['city'], $_FILES['file'])){
    $_SESSION['success'] = "La gauchada fue registrada con exito.";
}

header("Location: index.php");
die;


?>