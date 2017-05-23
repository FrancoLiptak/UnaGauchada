<?php

    include_once 'connect.php';
    include_once 'validate.php';
    session_start();

    function userLogin($email, $pass){
        // Retorna true si ambos parametros estan seteados y existe una y solo una tupla con el email y pass enviadas.
        // Setea la variable $_SESSION["idUsers"] con el id del usuario que cumple esta condicion. $_SESSION["admin"] = false.

        if ( validate($email) && validate($pass) ) {
            $link = connect();
            $query = "SELECT idUsers FROM users WHERE email = '$email' and pass = '$pass'";

            $result = $link->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $_SESSION["idUsers"] = $row["idUsers"];
                $_SESSION["admin"] = false;

                return true;

            }
            $_SESSION['mal']= "Verifica si te has registrado previamente en el sistema, o bien si el email y la contraseña que ingresaste son correctos.";
            return false;

        }
        $_SESSION['mal']= "Verifica si te has registrado previamente en el sistema, o bien si el email y la contraseña que ingresaste son correctos.";
        return false;
    }

    function adminLogin($email, $pass){
        // Retorna true si ambos parametros estan seteados y existe una y solo una tupla con el email y pass enviadas.
        // Setea la variable $_SESSION["id"] con el id del usuario que cumple esta condicion. $_SESSION["admin"] = true.

        if ( validate($email) && validate($pass) ) {
            $link = connect();
            $query = "SELECT id FROM admins WHERE email = '$email' and pass = '$pass'";

            $result = $link->query($query);

            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $_SESSION["idUsers"] = $row["idUsers"];
                $_SESSION["admin"] = true;

                return true;

            }

            return false;
        }

        return false;
    }

    function login($email, $pass) {
    	return userLogin($email, $pass) || adminLogin($email, $pass);
    }

?>