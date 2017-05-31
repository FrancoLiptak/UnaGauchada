<?php 
include_once 'validate.php';
include_once 'credits.php';

if (!	(	validate($_POST['pass']) && validate($_POST['nro'])	)	){
	$_SESSION['mal_completado']="Debes completar todos los campos!";
	if (! (validarCantidadCreditos($_POST['credits'] ) ) ){
		$_SESSION['mal_completado']= "El campo 'Créditos a comprar:' debe ser completado con un número sin coma!";
	}
}
elseif (validateCompra($_POST['nro'],$_POST['pass'],$_SESSION['idUsers'])) {
	incrementCredits($_SESSION['idUsers']);
	$_SESSION['bien']="Se ha efectuado la compra!";
}
elseif (	!(validateCompra($_POST['nro'],$_POST['pass'],$_SESSION['idUsers']))	) {
	$_SESSION['errorCompra']="Error al efectuarse la compra. Datos incorrectos o límite alcanzado.";
}
header("Location: comprarCreditos.php");
 ?>