<?php

include_once 'connect.php';
include_once 'validate.php';
include_once 'credits.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

define('KB', 1024);
define('MB', 1048576);
define('GB', 1073741824);
define('TB', 1099511627776);

function newGauchada($title, $description, $expiration, $category, $city, $img = null)
{
// Inserta una gauchada en la BD para el usuario logueado y decrementa en 1 sus creditos. Retorna true si se inserto correctamente, false si hubo algun error en la validacion o en la insercion.
    $link = connect();
    if (validateLogin() && validateCredits($_SESSION['idUsers']) && validate($title) && validate($description) && validateDate($expiration) && validate($category) && validate($city)) {
        if (isset($img['name']) && $img['name'] !== "") {
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

        $idUsers = $_SESSION['idUsers'];

        $query = "INSERT INTO gauchadas ( idUser, idCategory, idCity, title, description, expiration, image ) ";
        $query = $query."VALUES ( $idUsers, $category, $city, '$title', '$description', '$expiration', '$target_file');";


        if ($result = $link->query($query)) {
            decrementCredits($_SESSION['idUsers']);
        }
		else {
			$_SESSION['msg'] = $link->error;
		}

        return $result;
    }
    $_SESSION['msg'] = "No completo todos los campos.";

    return false;
}
