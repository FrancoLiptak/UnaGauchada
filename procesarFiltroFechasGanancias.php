<?php 
include_once 'validate.php';
include_once 'fxCompras.php';

$fechaMinima = $_POST['fechaMinima'];
$fechaMaxima = $_POST['fechaMaxima'];

if( ! (getVentas($fechaMaxima, $fechaMinima))){
   echo $_SESSION['msg'];
}else{
    echo "la fecha maxima es: $fechaMaxima |";
    echo "la fecha minima es: $fechaMinima";
}

/*
if ( ! ( validate($fechaMinima) && validate($fechaMaxima) ) ){
    $_SESSION['mal_completado'] = "Debes completar todos los campos.";
    }elseif ($fechaMinima > $fechaMaxima){
        $_SESSION['mal_completado'] = "La fecha mínima ingresada debe ser menor a la fecha máxima ingresada.";
        }elseif (getVentas($fechaMaxima, $fechaMinima)){
			header("Location: ganancias.php");
            die;
        }else{
            $_SESSION['mal_completado'] = "Hubo un error en la consulta.";
            header("Location: ganancias.php");
            die;
        }

header("Location: ganancias.php");

*/
 ?>