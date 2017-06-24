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

function logroConRep($user){
    $logro= calculateLogro($user);
    $logro_name= $logro['name'];
    return ($logro_name." (".$user['reputation'].")");
}
