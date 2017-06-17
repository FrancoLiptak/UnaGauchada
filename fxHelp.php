<?php
include_once  'validate.php';

function newHelp($idUser, $idGauchada, $description = "")
{
    if (validateUser($idUser) && validateGauchada($idGauchada)) {
        $link = connect();
        $query = "INSERT INTO help (idUsers, idGauchada, description)";
        $query = $query."VALUES ($idUser, $idGauchada, '$description')";
        if ($result = $link->query($query)) {
            return $result;
        }
        $_SESSION['msg'] = $link->error;
    }
    return false;
}

function getHelps($idGauchada)
{
    if(validateGauchada($idGauchada)){
        $link = connect();
        $query = "SELECT * FROM help WHERE idGauchada = $idGauchada;";
        $result = $link->query($query);
        return $result;
    }
    return false;
}

function getOneHelp($idGauchada, $idUser)
{
    if(validateGauchada($idGauchada) && validateUser($idUser)){
        $link = connect();
        $query = "SELECT * FROM help WHERE idGauchada = $idGauchada AND idUsers = $idUser;";
        $result = $link->query($query);
        return $result;
    }
    return false;
}
