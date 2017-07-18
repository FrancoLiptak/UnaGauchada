<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include_once 'connect.php';
include_once 'usersFx.php';

$user = (getUser($_SESSION['idUsers']))->fetch_assoc();

if (isset($_POST['pass1'], $_POST['pass2']) && $_POST['pass1'] != $_POST['pass2']) {
    $_SESSION['msg'] = "Las contraseñas ingresadas no coinciden";
}
elseif (isset($_POST['name'], $_POST['surname'], $_POST['email'], $_POST['birthDate'])) {


    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $birthDate = $_POST['birthDate'];
    $phone = "";

    if (isset($_POST['phone'])) {
        $phone = $_POST['phone'];
    }
    
    $modifyPass = modifyPass();

    $img = null;

    if(isset($_FILES['imgInp'])){
        $img = $_FILES['imgInp'];
    }

    editUser($name, $surname, $email, $birthDate, $phone, $modifyPass, $img);

}
else {
    $_SESSION = "Dejó vacio alguno de los campos.";
}

header("Location: editarPerfil.php");
die;

function modifyPass(){
    include_once 'validate.php';

    if (!isset($_POST['pass1'], $_POST['pass2'])) {
        return false;
    }

    if (!$_POST['pass1'] == $_POST['pass2']) {
        $_SESSION['msg'] = "Las contraseñas ingresadas no coinciden";
        return false;
    }

    $pass = trim($_POST['pass1']);
    if (!validateSize($pass, 20)) {
        $_SESSION['msg'] = 'La contraseña tiene mas de 20 caracteres.';
        return false;
    }

    return $pass;
}

function editUser($name, $surname, $email, $birthDate, $phone, $modifyPass, $img){
    include_once 'validate.php';

    define('KB', 1024);
    define('MB', 1048576);
    define('GB', 1073741824);
    define('TB', 1099511627776);

    $link = connect();

    $user=(getUser($_SESSION['idUsers']))->fetch_assoc();
    $loggedId=$user['idUsers'];

    $name = trim($name);
    $surname = trim($surname);
    $email = trim($email);
    $phone = trim($phone);

    if (!validateEmail($email)) {
        $_SESSION['msg']= "El email ingresado no es un email valido.";
        return false;
    }

    if (($user['email'] != $email && !isUnique($email))) {
        $_SESSION['msg']= "El email ingresado ya esta en uso.";
        return false;
    }

    if (validate($name) && validate($surname) && validateDate($birthDate)) {
        if (!validateSize($name)) {
            $_SESSION['msg'] = 'El nombre tiene mas de 50 caracteres.';
            return false;
        }
        if (!validateSize($surname)) {
            $_SESSION['msg'] = 'El apellido tiene mas de 50 caracteres.';
            return false;
        }
        if (!validateSize($email)) {
            $_SESSION['msg'] = 'El email tiene mas de 50 caracteres.';
            return false;
        }

        $target_file = $user['photo'];
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
        $query = "UPDATE users SET name='$name', surname='$surname', email='$email', birthDate='$birthDate', phone='$phone', photo='$target_file'";
        if ($modifyPass) {
            $query = $query.", pass=$modifyPass";
        }
        $query = $query." WHERE idUsers=$loggedId";
        $result = $link->query($query);

        if ($result) {
            $_SESSION['msg']="Se actualizo su informacion.";
            return true;
        } else {
            $_SESSION['msg'] = $link->error;
            return $result;
        }
    }

    $_SESSION['msg']= "Verifica si has completado todos los campos obligatorios.<br>También recuerda que deben coincidir las passwords...";
    return false;
}
