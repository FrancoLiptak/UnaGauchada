<?php

include_once 'connect.php';
include_once 'validate.php';

	function newUser($email, $pass, $name, $surname, $birthDate, $phone, $photo) {
		// Crea un nuevo usuario con los parametros enviados. Devuelve true si el query se realizo correctamente, false caso contrario. Setear los valores default de $startingCredits and $startingReputation.

		$link = connect();

		if ( validate($email) && validate($pass) && validate($name) && validate($surname) && validateDate($birthDate) ) {

			// FALTA MANEJO DE IMAGENES.
			$photo = "";

			if (!validate($phone)) {
				$phone = "";
			}
			$startingCredits = 1;
			$startingReputation = 1;

	        $query = "INSERT INTO 'users' ( 'idUser', 'email', 'pass', 'name', 'surname', 'birthDate', 'phone', 'credits', 'reputation', 'photo' ) "; 
	        $query = $query."VALUES ( NULL, '$email', '$pass', '$name', '$surname', '$birthDate', '$phone' '$startingCredits', '$reputation', '$photo' );";
	        $result = $link->query($query);

	        return $result;
		}

		return false;
	}

	function newAdmin($email, $pass, $name, $surname, $birthDate, $phone, $photo) {
		// Crea un nuevo usuario con los parametros enviados. Devuelve true si el query se realizo correctamente, false caso contrario. Setear los valores default de $startingCredits and $startingReputation.

		$link = connect();

		if ( validate($email) && validate($pass) && validate($name) && validate($surname) && validateDate($birthDate) ) {

			// FALTA MANEJO DE IMAGENES.
			$photo = "";

			if (!validate($phone)) {
				$phone = "";
			}
			$startingCredits = 1;
			$startingReputation = 1;

	        $query = "INSERT INTO 'admins' ( 'idUser', 'email', 'pass', 'name', 'surname', 'birthDate', 'phone', 'credits', 'reputation', 'photo' ) "; 
	        $query = $query."VALUES ( NULL, '$email', '$pass', '$name', '$surname', '$birthDate', '$phone' '$startingCredits', '$reputation', '$photo' );";
	        $result = $link->query($query);

	        return $result;
		}

		return false;
	}


?>