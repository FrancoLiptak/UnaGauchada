<?php 
include_once 'validate.php';
include_once 'credits.php';
session_start();
if (!	(	validate($POST['pass']) && validate($POST['num']) && validate($POST['credits'])	)	){
	$SESSION['mal_completado']="Debes completar todos los campos!";
}
elseif (validateCompra($POST['nro'],$POST['pass'],$SESSION['idUsers'])) {
	incrementCredits($SESSION['idUsers']));
	$SESSION['bien']="Se ha efectuado la compra!";
}
elseif (	!(validateCompra($POST['nro'],$POST['pass'],$SESSION['idUsers']))	) {
	$SESSION['errorCompra']="Error al efectuarse la compra. Datos incorrectos o límite alcanzado.";
}
header("Location: comprarCreditos.php");
 ?>