<?php

	include_once 'connect.php';
	include_once 'validate.php';
	include_once 'credits.php';
	session_start();

	function newGauchada($img, $desc, $title, $endDate, $idCity, $idCate) {
		// Inserta una gauchada en la BD para el usuario logueado y decrementa en 1 sus creditos. Retorna true si se inserto correctamente, false si hubo algun error en la validacion o en la insercion.
		$link = connect();

		if ( validateLogin() && validateCredits() && validate($desc) && validate($title) && validateDate($endDate) && validate($location) && validate($cate) ) {

			// FALTA MANEJO DE IMAGENES.

			$date = date("Y/m/d");
			$idUser = $_SESSION['idUser'];

	        $query = "INSERT INTO 'gauchadas' ('idGauchada', 'idUser', 'idCategory', 'idCity', 'title', 'description', 'date', 'endDate', 'img') "; 
	        $query = $query."VALUES (NULL, '$idUser', '$idCate', '$idCity', '$title', '$desc', '$date' '$endDate', '$img');";
	        $result = $link->query($query);

	       	decrementCredits();

	        return $result;
		}

		return false;
	}

?>