<?php 
include_once 'validate.php';
include_once 'credits.php';

if (!	(	validateCardNumber($_POST['nro']) && validatePin($_POST['pass'])	)	){
	$_SESSION['mal_completado']=  "Debes completar todos los campos. Recuerda revisar la longitud del número de tarjeta y la clave!";
}
elseif ( ! ( validarCantidadCreditos($_POST['credits'] ) ) ){
		$_SESSION['mal_completado']= "El campo 'Créditos a comprar' debe ser completado con un número sin coma!";
}
elseif (validateCompra($_POST['nro'],$_POST['pass'],$_SESSION['idUsers'] )) {
	incrementCredits($_SESSION['idUsers'], $_POST['credits']);
	$_SESSION['bien']="Se ha efectuado la compra!";
}
else{
	$_SESSION['errorEnCompra']="Error al efectuarse la compra. Datos incorrectos o límite alcanzado.";
}
header("Location: comprarCreditos.php");
 ?>