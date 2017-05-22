<?php

include_once 'connect.php';

	function validate($var) {
	    // Retorna true si el parametro esta seteado y es distinto de "".

		return isset($var) && $var != "";

	}

	function validateDate($date, $format = 'Y-m-d') {
		// Devuelve true si la fecha existe. Por defecto usa el formato YYYY - MM - DD .

	    $d = DateTime::createFromFormat($format, $date);
	    return $d->format($format) == $date;
	}

	function validateLogin() {
		// Devuelve true si hay un usuario logueado.

		return isset($_SESSION['idUser']);
	}

?>