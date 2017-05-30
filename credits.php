<?php

include_once 'connect.php';
include_once 'validate.php';
include_once 'getUser.php';

function getCredits($idUser)
{
// Devuelve los creditos del usuario con id = $idUser. Si hay un error en la consulta, devuelve false.

    $link = connect();

    $query = "SELECT credits FROM users WHERE idUsers = '$idUser'";
    $result = $link->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        return $row['credits'];
    }


    return false;
}

function validateCredits($idUser)
{
// Devuelve true si la cantidad de creditos del usuario $idUser es >= 1.

    return getCredits($idUser) >= 1;
}

function incrementCredits($idUser, $amount = 1)
{
// Aumenta en $amount la cantidad de creditos del usuario con id = $idUser.

    $credits = getCredits($idUser) + $amount;
    $link = connect();
    $query = "UPDATE users SET credits=$credits WHERE idUsers=$idUser";
    return $link->query($query);
}

function decrementCredits($idUser, $amount = 1)
{
// Decrementa en 1 la cantidad de creditos del usuario $idUser. Devuelve true si no hubo errores en el query.

    return incrementCredits($idUser, $amount * -1);
}

function creditValue()
{
// Retorna el precio de los creditos o false en caso de error.
    $link = connect();

    $query = "SELECT * FROM credit WHERE idCredit = 1";
    $result = $link->query($query);

    if ($result) {
        if ($row = $result->fetch_array()) {
            return $row['price'];
        }
    }

    return false;
}
