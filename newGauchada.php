<?php

	include_once 'connect.php';
	include_once 'validate.php';
	include_once 'credits.php';
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	function newGauchada($title, $description, $expiration, $category, $city, $img = NULL) {
		// Inserta una gauchada en la BD para el usuario logueado y decrementa en 1 sus creditos. Retorna true si se inserto correctamente, false si hubo algun error en la validacion o en la insercion.
		$link = connect();

		if ( validateLogin() && validateCredits($_SESSION['idUsers']) && validate($title) && validate($description) && validateDate($expiration) && validate($category) && validate($city) ) {

			// FALTA MANEJO DE IMAGENES.
			$idUsers = $_SESSION['idUsers'];

	        $query = "INSERT INTO gauchadas ( idUser, idCategory, idCity, title, description, expiration, image ) "; 
	        $query = $query."VALUES ( $idUsers, $category, $city, '$title', '$description', '$expiration', '$img');";

	        if ($result = $link->query($query)) {
		    	   	decrementCredits($_SESSION['idUsers']);
			}
	        return $result;
		}
		return false;
	}
?>