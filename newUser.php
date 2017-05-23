<?php

include_once 'connect.php';
include_once 'validate.php';
session_start();

	function newUser($email, $pass1, $pass2, $name, $surname, $birthDate, $phone) {
		// Crea un nuevo usuario con los parametros enviados. Devuelve true si el query se realizo correctamente, false caso contrario. Setear los valores default de $startingCredits and $startingReputation.
		
		$link = connect();

		if ( validateEmail($email) && validatePasswords($pass1, $pass2) && validate($name) && validate($surname) && validateDate($birthDate) ) {

			if (!validate($phone)) {
				$phone = "";
			}
			$startingCredits = 1;
			$startingReputation = 1;

	        $query = "INSERT INTO users ( email, pass, name, surname, birthDate, credits, reputation ) "; 
	        $query = $query."VALUES ( '$email', '$pass', '$name', '$surname', '$birthDate', $startingCredits, $startingReputation );";
	        $result = $link->query($query);

	        $_SESSION['registrado']="Se ha realizado el Sign up con éxito!";
	     	return $result;
		}
		else{
		$_SESSION['mal_completado']= "Verifica si has completado todos los campos. Son de caracter obligatorio!<br>También recuerda que deben coincidir las passwords...";
		return false;
		}
	}

	function newAdmin($email, $pass, $name, $surname, $birthDate, $phone) {
		// Crea un nuevo usuario con los parametros enviados. Devuelve true si el query se realizo correctamente, false caso contrario. Setear los valores default de $startingCredits and $startingReputation.

		$link = connect();

		if ( validate($email) && validate($pass) && validate($name) && validate($surname) && validateDate($birthDate) ) {

			if (!validate($phone)) {
				$phone = "";
			}
			$startingCredits = 1;
			$startingReputation = 1;

	        $query = "INSERT INTO 'admins' ( 'idUser', 'email', 'pass', 'name', 'surname', 'birthDate', 'phone', 'credits', 'reputation') "; 
	        $query = $query."VALUES ( NULL, '$email', '$pass', '$name', '$surname', '$birthDate', '$phone' '$startingCredits', '$reputation' );";
	        $result = $link->query($query);

	        return $result;
		}

		return false;
	}


?>