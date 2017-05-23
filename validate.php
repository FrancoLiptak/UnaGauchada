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
	function validatePasswords($p1, $p2) {
			// Devuelve true si las contraseñas no son vacias y coinciden.

			return validate($p1) && validate($p2) && ($p1 == $p2);
		}
	function validateEmail($email) {
		// Devuelve true si el email no esta en uso en la db, false caso contrario.

		return validate($email) && isUnique($email);
	}
	function isUnique($email){
		// Devuelve true si el email es unico en la DB

		$link= connect();
		$totalTuplas= mysqli_query($link, "SELECT * FROM users WHERE email='$email'"); //me traigo todas
        $cantTotalTuplas = mysqli_num_rows($totalTuplas);
		if ($cantTotalTuplas != 0 ){
			$_SESSION['otro_email']= "Ingesa otro email. Ese email ya existe!";
			return false;
		}
		else{
			return true;
		}
	}
?>