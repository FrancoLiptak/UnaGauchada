<?php

include_once 'connect.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


function validate($var)
{
    // Retorna true si el parametro esta seteado y es distinto de "".

    return isset($var) && $var != "";
}

function validarCantidadCreditos($var)
{
    // Retorna true si el parametro esta seteado y es distinto de "".

    return isset($var) && $var != "" && intval($var) && ($var > 0);
}

function isMayor($date, $format = 'Y-m-d')
{
    $d = DateTime::createFromFormat($format, $date);
    $hoy = date($format);
    $hoy->sub($d);
    return $fecha->format('Y') >= 18;
}

function validateDate($date, $format = 'Y-m-d')
{
    // Devuelve true si la fecha existe. Por defecto usa el formato YYYY - MM - DD .

    $d = DateTime::createFromFormat($format, $date);
    return $d->format($format) == $date;
}

function validateLogin()
{
    // Devuelve true si hay un usuario logueado.

    return isset($_SESSION['idUsers']);
}
function validatePasswords($p1, $p2)
{
    // Devuelve true si las contraseñas no son vacias y coinciden.

    return validate($p1) && validate($p2) && ($p1 == $p2);
}
function validateEmail($email)
{
    // Devuelve true si el email no esta en uso en la db, false caso contrario.

    return validate($email) && boolval(filter_var($email, FILTER_VALIDATE_EMAIL)) ;
}
function validateEmailLogin($email)
{

    return validate($email) && boolval(filter_var($email, FILTER_VALIDATE_EMAIL));
}
function isUnique($email)
{
    // Devuelve true si el email es unico en la DB

    $link= connect();
    $totalTuplas= mysqli_query($link, "SELECT * FROM users WHERE email='$email'"); //me traigo todas
    $cantTotalTuplas = mysqli_num_rows($totalTuplas);

    if ($cantTotalTuplas != 0) {
        $_SESSION['otro_email']= "Ingesa otro email. Ese email ya existe!";
        return false;
    }

    return true;
}
function validateTarjeta($nro, $pass)
{
    // Devuelve true si la tarjeta existe.
    $link= connect();
    $query=mysqli_query($link, "SELECT * FROM tarjetas WHERE nro=$nro ;" );
    if ($query) {
        if ($query->num_rows == 0) {
            $_SESSION['no-existe']='La tarjeta no existe!';
            return false;
        } else {
            return true;
        }
    } else {
        $_SESSION['errorCompra']='Error en la consulta!';
        return false;
    }
}
function validatePassTarjeta($nro, $pass)
{
    // Devuelve true si la tarjeta pass coincide para esa tarjeta.
    $link= connect();
    $query=mysqli_query($link, "SELECT * FROM tarjetas WHERE nro=$nro and pass=$pass;" );
    $tarjeta= mysqli_fetch_array($query);

    if ($query) {
        if ($query->num_rows == 0) {
            $_SESSION['no-existe']='La tarjeta no se corresponde con esa contraseña!';
            return false;
        } else {
            return true;
        }
    } else {
        $_SESSION['errorCompra']='Error en la consulta!';
        return false;
    }
}
function validateEstadoTarjeta($nro, $pass)
{
    // Devuelve true si la tarjeta no pasó el límite.
    $link= connect();
    $query=mysqli_query($link, "SELECT estado FROM tarjetas WHERE nro=$nro and pass=$pass;" );
    $tarjeta= mysqli_fetch_array($query);

    if (!($tarjeta['estado'])) {
        $_SESSION['estado-false']='La tarjeta ha alcanzado el límite!';
        return false;
    } else {
        return true;
    }
}
function validateCompra($nro, $pass)
{
    // Devuelve true si la tarjeta existe, la contraseña es correcta, y se puede hacer la compra.
   
    return  validateTarjeta($nro, $pass) && validatePassTarjeta($nro, $pass) && validateEstadoTarjeta($nro, $pass);
}

function isAdmin()
{
    return $_SESSION["admin"];
}

function validateSize($var, $max = 50)
{
    return strlen($var) <= $max;
}

function validateCardNumber($number)
{
    return (((strlen($number)) >= 13 && (strlen($number)) <= 16));
}

function validatePin($number)
{
    $tamaño = strlen($number);
    return ($tamaño = 3);
}

function validateUser($idUser)
{
    if (validate($idUser)) {
        $link = connect();
        $query = "SELECT users WHERE idUser = $idUser";
        if ($result = $link->query($query)) {
            return $result->num_rows == 1;
        }
        $_SESSION['msg'] = $link->error;
        return false;
    }
}
function validateGauchada($idGauchada)
{
    if (validate($idGauchada)) {
        $link = connect();
        $query = "SELECT gauchadas WHERE idGauchada = $idGauchada";
        if ($result = $link->query($query)) {
            return $result->num_rows == 1;
        }
        $_SESSION['msg'] = $link->error;
        return false;
    }
}
