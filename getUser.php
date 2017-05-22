<?php

    include_once 'validate.php';
    session_start();

    function getLoggedUser(){
        if (validateLogin()) {
            return $_SESSION['idUser'];
        }
        return false;
    }

?>