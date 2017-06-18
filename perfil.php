<?php 
include_once 'validate.php';
if (!(validate($_SESSION['idUsers']))){
                $_SESSION['msg'] = "No estas logueado! No podes acceder a ver perfil.";
                header('Location: index.php');
                die;
            }
include_once "header.php";
include_once 'usersFx.php';
include_once 'alert.php';
?>

<html>
<head>
    <title>Perfil</title>
    <div class="row center-block">
    	<?php
            showUser(   mysqli_fetch_array(getUser($_SESSION['idUsers']))  );        //no hago ningun validate del idUsers porque lo hice arriba
        ?>

   	</div>

<br><br><br><br>
<?php include("footer.html");?>
