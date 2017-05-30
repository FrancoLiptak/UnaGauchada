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

    return validate($email) && boolval(filter_var($email, FILTER_VALIDATE_EMAIL)) && isUnique($email);
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
function validateCompra($nro, $pass, $idUser)
{
    // Devuelve true si la contraseña es correcta, y se puede hacer la compra.
    $link= connect();
    $query=mysqli_query($link, "SELECT * FROM tarjetas WHERE nro=$nro and pass=$pass and idUser=$idUser;" );
    $tarjeta= mysqli_fetch_array($query);

    return  $query && $tarjeta['estado'];
}

function isAdmin()
{
    return $_SESSION["admin"];
}
