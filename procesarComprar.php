<?php 
include_once 'validate.php';
include_once 'credits.php';

if (!	(	validateCardNumber($_POST['nro']) && validatePin($_POST['pass'])	)	){
	$_SESSION['mal_completado']=  "Debes completar todos los campos. Recuerda revisar la longitud del número de tarjeta y la clave!";
}
elseif ( ! ( validarCantidadCreditos($_POST['credits'] ) ) ){
		$_SESSION['mal_completado']= "El campo 'Créditos a comprar' debe ser completado con un número positivo sin coma!";
}
elseif (validateCompra($_POST['nro'],$_POST['pass'])) {
	incrementCredits($_SESSION['idUsers'], $_POST['credits']);
	$_SESSION['bien']="Se ha efectuado la compra!";
}

header("Location: comprarCreditos.php");
 ?>