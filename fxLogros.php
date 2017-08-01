<?php
include_once 'validate.php';

function getLogros()
{
    $link = connect();
    $query = "SELECT * FROM logros ORDER BY min DESC";
    if ($result = $link->query($query)) {
        return $result;
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function getLogro($id)
{
    $link = connect();
    $query = "SELECT * FROM logros WHERE idLogros = $id";
    if ($result = $link->query($query)) {
        return $result;
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function calculateLogro($user)
{
    $allLogros = getLogros();
    while($logro = $allLogros->fetch_assoc()) {
        if ($user['reputation'] > $logro['min']) {
            return $logro;
        }
    }
    return false;
}

function calculateLogroRep($rep)
{
    $allLogros = getLogros();
    while($logro = $allLogros->fetch_assoc()) {
        if ($rep > $logro['min']) {
            return $logro;
        }
    }
    return false;
}

function logroConRep($user){
    $logro= calculateLogro($user);
    $logro_name= $logro['name'];
    return ($logro_name." (".$user['reputation'].")");
}

function logroNameExists($id, $name) {
    $link = connect();
    $query = "SELECT * FROM logros WHERE name = '$name'";
    if ($result = $link->query($query)) {
        $logro = $result->fetch_assoc();
        return ($result->num_rows == 1 && !($logro['idLogros'] == $id));
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function logroNameExistsNoId($name) {
    $link = connect();
    $query = "SELECT * FROM logros WHERE name = '$name'";
    if ($result = $link->query($query)) {
        $logro = $result->fetch_assoc();
        return ($result->num_rows == 1);
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function logroMinExists($id, $min) {
    $link = connect();
    $query = "SELECT * FROM logros WHERE min = $min";
    if ($result = $link->query($query)) {
        $logro = $result->fetch_assoc();
        return ($result->num_rows == 1 && !($logro['idLogros'] == $id));
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function logroMinExistsNoId($min) {
    $link = connect();
    $query = "SELECT * FROM logros WHERE min = $min";
    if ($result = $link->query($query)) {
        $logro = $result->fetch_assoc();
        return ($result->num_rows == 1);
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function newLogro($name, $min){
    $name = trim($name);
    if (!validate($name)) {
        return false;
    }
    $min = trim($min);
    if (!validate($min)) {
        return false;
    }

    $link = connect();
    $query = "INSERT INTO logros (name, min)";
    $query = $query."VALUES ('$name', $min)";
    if ($result = $link->query($query)) {
        $_SESSION['success'] = "El logro $name con minimo $min se creo correctamente.";
        return $result;
    }
    $_SESSION['msg'] = $link->error;
}

function editLogro($id, $name, $min) {
    $link = connect();
    $query = "UPDATE logros SET name='$name', min=$min WHERE idLogros=$id;";
    if ($result = $link->query($query)) {
        $_SESSION['success'] = "El logro $id se modifico correctamente.";
        return $result;
    }
    $_SESSION['msg'] = $link->error;
    return false;

}

function deleteLogro($id) {
    $link = connect();
    $query = "DELETE FROM logros WHERE idLogros=$id;";
    if ($result = $link->query($query)) {
        $_SESSION['success'] = "El logro $id se elimino correctamente.";
        return $result;
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function getRanking() {
    include_once 'usersFx.php';
    $result = getForRanking();
    $users = array();
    while ($current = $result->fetch_assoc()) {
        $user['nombre'] = $current['name'];
        $user['apellido'] = $current['surname'];
        $user['reputacion'] = $current['reputation'];
        $user['logro'] = calculateLogroRep($current['reputation'])['name'];
        $users[] = $user;
    }
    return $users;
}