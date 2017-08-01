<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once 'connect.php';
include_once 'gauchadasFx.php';

if (isset($_POST['idGau'], $_SESSION['idUsers'])) {
	$id = $_POST['idGau'];
	$gauchada = getOneGauchada($id);
	$isOwner = $gauchada['idUser'] == $_SESSION['idUsers'];
}
else {
	$_SESSION['msg'] = "Algo salio mal, vuelva a intentarlo mas tarde.";
	header("Location: index.php");
	die;
}

if (!$isOwner) {
	$_SESSION['msg'] = "No es el dueño de esta gauchada.";
	header("Location: gauchadaVer.php?idGauchadas=$id");
	die;
}

if (!isset($_POST['cate'], $_POST['city'], $_POST['title'], $_POST['description'], $_POST['expiration'])){
	$_SESSION['msg'] = "Dejó vacio alguno de los campos.";
	header("Location: gauchadaVer.php?idGauchadas=$id");
	die;
}

$cat = $_POST['cate'];
$city = $_POST['city'];
$title = $_POST['title'];
$desc = $_POST['description'];
$exp = $_POST['expiration'];
$img = $gauchada['image'];

if (isset($_FILES['image'])){
	$img = $_FILES['image'];
}

editGauchada($id, $cat, $city, $title, $desc, $exp, $img);

 header("Location: gauchadaVer.php?idGauchadas=$id");
die;

function editGauchada($id, $cat, $city, $title, $desc, $exp, $img){
    include_once 'validate.php';

    define('KB', 1024);
    define('MB', 1048576);
    define('GB', 1073741824);
    define('TB', 1099511627776);

    $link = connect();

    $user= mysqli_fetch_assoc(getUser($_SESSION['idUsers']));
	$gauchada = (getOneGauchada($id));
    $title = trim($title);
    $desc = trim($desc);

	if (!validateCate($cat)){
		$_SESSION['msg'] = "La categoria seleccionada es invalida.";
		return false;
	}

	if (!validateCity($city)){
		$_SESSION['msg'] = "La ciudad seleccionada es invalida.";
		return false;
	}

    if (validate($title) && validate($desc) && validateDate($exp)) {
        if (!validateSize($title)) {
            $_SESSION['msg'] = 'El nombre tiene mas de 50 caracteres.';
            return false;
        }

        $target_file = $gauchada['image'];
        if (!$img['name'] == "") {
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

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
                $_SESSION['msg'] = 'Solo se aceptan imagenes de tipo JPEG, JPG, PNG.';
                return false;
            }

            if (!move_uploaded_file($img["tmp_name"], $target_file)) {
                $_SESSION['msg'] = 'No se pudo subir tu imagen :(.';
                return false;
            }
        }

        $query = "UPDATE gauchadas SET idCategory='$cat', idCity='$city', title='$title', description='$desc', expiration='$exp', image='$target_file'";
        $query = $query." WHERE idGauchadas=$id";
        $result = $link->query($query);

        if ($result) {
            $_SESSION['success']="Se ha realizado la edicion con éxito.";
            return true;
        } else {
            $_SESSION['msg'] = $link->error;
            return $result;
        }
    }

    $_SESSION['msg']= "Verifica si has completado todos los campos obligatorios.";
    return false;
}
