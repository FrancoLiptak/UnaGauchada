<?php

include_once 'connect.php';
include_once 'validate.php';
session_start();

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);


	function newUser($email, $pass1, $pass2, $name, $surname, $birthDate, $phone, $img = null) {
		// Crea un nuevo usuario con los parametros enviados. Devuelve true si el query se realizo correctamente, false caso contrario. Setear los valores default de $startingCredits and $startingReputation.
		
		$link = connect();

		if ( !validateEmail($email) ) {
			return false;
		}

		if ( validatePasswords($pass1, $pass2) && validate($name) && validate($surname) && validateDate($birthDate) ) {
		$target_dir = null;
		if (!$img == null) {
            $target_dir = "uploads/";
            $file = rand(1000, 100000)."-".$img['name'];
            $target_file = $target_dir . basename($file);

            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            $check = getimagesize($img["tmp_name"]);
            if ($check == false) {
                $_SESSION['msg'] = "El archivo seleccionado no es una imagen.";
                return false;
            }

            while (file_exists($target_file)) {
                $file = rand(1000, 100000)."-".$img['name'];
                $target_file = $target_dir . basename($file);
            }

            $file_size = $img['size'];
            if (!($file_size < 15*MB || $file_size == 0 )) {
                $_SESSION['msg'] = "La imagen debe pesar menos de 15MB";
                return false;
            }

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                $_SESSION['msg'] = 'Solo se aceptan imagenes de tipo JPEG, JPG, PNG.';
                return false;
            }

            if (!move_uploaded_file($img["tmp_name"], $target_file)) {
                $_SESSION['msg'] = 'No se pudo subir tu imagen :(.';
                return false;
            }
        }


			if (!validate($phone)) {
				$phone = "";
			}

			$startingCredits = 1;
			$startingReputation = 1;

	        $query = "INSERT INTO users ( email, pass, name, surname, birthDate, credits, reputation, photo ) "; 
	        $query = $query."VALUES ( '$email', '$pass1', '$name', '$surname', '$birthDate', $startingCredits, $startingReputation, '$target_file' );";
	        $result = $link->query($query);

			if ($result) {
		        $_SESSION['registrado']="Se ha realizado el Sign up con éxito!";
				return true;
			}
			else {
		        $_SESSION['registrado']="Dio mal la consulta.";
		     	return $result;
			}
		}

		$_SESSION['mal_completado']= "Verifica si has completado todos los campos. Son de caracter obligatorio!<br>También recuerda que deben coincidir las passwords...";
		return false;
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