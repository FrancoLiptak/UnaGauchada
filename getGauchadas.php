<?php

	include_once 'connect.php';

	function getGauchadas($limit, $first, $condition = "1 = 1") {
		// Retorna las proximas $limit gauchadas comenzando desde la tupla numero $first que cumplen la condicion $condition.

		$link = connect();
		$query = "SELECT * FROM gauchadas ORDER BY $date LIMIT $first, $limit WHERE ".$condition.";";

		return $link->query($query);
	}

	function getOneGauchada($idGauchada) {
		// Retorna la gauchada con idGauchada = $idGauchada.

		return getGauchadas(1, 0, "idGauchada = $idGauchada");
	}

?>