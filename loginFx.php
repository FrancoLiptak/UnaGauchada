<?php

    include_once 'connect.php';
    include_once 'validate.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function userLogin($email, $pass)
{
    // Retorna true si ambos parametros estan seteados y existe una y solo una tupla con el email y pass enviadas.
    // Setea la variable $_SESSION["idUsers"] con el id del usuario que cumple esta condicion. $_SESSION["admin"] = false.

    if (validate($email) && validate($pass)) {
        $link = connect();
        $queryEmail = "SELECT idUsers FROM users WHERE email = '$email'";

        $emailResult = $link->query($queryEmail);

        if ($emailResult) {
            if ($emailResult->num_rows == 0) {
                $_SESSION['msg'] = "El mail ingresado todavia no fue usado para registrar un usuario.";
                return false;
            }
        }

        $query = "SELECT idUsers, admin FROM users WHERE email = '$email' and pass = '$pass'";

        $result = $link->query($query);

        if ($result) {
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $_SESSION["idUsers"] = $row["idUsers"];
                $_SESSION["admin"] = $row["admin"];
                return true;
            }
        }
        $_SESSION['mal']= "La contraseña que ingresaste no corresponde a ese mail. Vuelve a intentarlo.";
        return false;
    }
    $_SESSION['mal']= "Los campos de email y contraseña no fueron completados correctamente.";
    return false;
}
