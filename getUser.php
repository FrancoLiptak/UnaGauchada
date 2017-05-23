<?php

    include_once 'validate.php';
    include_once 'connect.php';
    session_start();

    function getLoggedUser(){
        if (validateLogin()) {
            return $_SESSION['idUsers'];
        }
        return false;
    }

    function getNameFromLoggedUser(){ /* //ACA VA LO QUE ESTA ARRIBA EN EL HEADER
        if (validateLogin()) {
  			$link= connect();
         	$sql="select name from users where idUsers=".$_SESSION['idUsers'].";";
            $result= mysqli_query($link, $sql);
            $user = mysqli_fetch_array($result);
            $name=$user['name'];
            return $name;
        }*/
    }

?>