<?php

    $user;

    function getUser($idUser) {
        $link = connect();
		$query = "SELECT * FROM users WHERE idUsers = $idUser;";
        $result = $link->query($query);
        if (!$result) {
            printf("Errormessage: %s\n", $link->error);
            return false;
        }
		global $user;
        $user = mysqli_fetch_array($result);
        return $result;
	}

    function getName(){
        global $user;
        echo $user['name'];
    }

    function getSurname(){
        global $user;
        echo $user['surname'];
    }

    function getEmail(){
        global $user;
        echo $user['email'];
    }

    function getBirthDate(){
        global $user;
        echo $user['birthDate'];
    }

    function getPhone(){
        global $user;
        echo $user['phone'];
    }

    function getReputation(){
        global $user;
        echo $user['reputation'];
    }

    function getCredits(){
        global $user;
        echo $user['credits'];
    }

    function getPhoto(){
        global $user;
        echo $user['photo'];
    }
?>