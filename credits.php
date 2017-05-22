<?php

	include_once 'connect.php';
	include_once 'validate.php';
	include_once 'getUser.php';
	session_start();

	function getCredits($idUser) {
		// Devuelve los creditos del usuario con id = $idUser. Si hay un error en la consulta, devuelve false.

		$link = connect();

        $query = "SELECT credits FROM users WHERE idUser = '$idUser'";
		$result = $link->query($query);

		if ($result->num_rows = 1) {
			$row = $result->fetch_assoc();
			return $row['credits'];
		}

		return false;
	}

	function validateCredits($idUser) {
		// Devuelve true si la cantidad de creditos del usuario $idUser es >= 1.

		return getCredits($idUser) >= 1;
	}

	function incrementCredits($idUser, $amount = 1) {
		// Aumenta en $amount la cantidad de creditos del usuario con id = $idUser.

		$credits = getCredits($idUser) + $amount;
		$link = connect();
		$query = "UPDATE users SET credits=$credits WHERE idUser=$idUser";
		return $link->query($query);
	}

	function decrementCredits($idUser, $amount = 1) {
		// Decrementa en 1 la cantidad de creditos del usuario $idUser. Devuelve true si no hubo errores en el query.

		return incrementCredits($idUser, $amount * -1);
	}

?>