<?php
include_once 'connect.php';
include_once 'gauchadasFx.php';

function newScore($idGauchada, $rep, $description)
{
    $link = connect();
    if (validateGauchada($idGauchada)) {
        $query = "INSERT INTO score (idGauchadas, points, description)";
        $query = $query."VALUES ($idGauchada, $rep, '$description')";
        if ($result = $link->query($query)) {
            $_SESSION['success'] = "Se puntuo correctamente.";
            return $result;
        }
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function hasScore($idGauchada)
{
    return getScoreForGauchada($idGauchada)->num_rows>0;    
}

function getScoreForGauchada($idGauchada)
{
    $link = connect();
    if (validateGauchada($idGauchada)) {
        $query = "SELECT * FROM score WHERE idGauchadas=$idGauchada";
        if ($result = $link->query($query)) {
            return $result;
        }
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function getScore($idScore){
    $link = connect();
    if (validate($idScore)) {
        $query = "SELECT * FROM score WHERE idScore=$idScore";
        if ($result = $link->query($query)) {
            return $result;
        }
    }
    $_SESSION['msg'] = $link->error;
    return false;
}