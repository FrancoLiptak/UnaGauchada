<?php

    function getUser($idUser) {
        $link = connect();
		$query = "SELECT * FROM users WHERE idUsers = $idUser;";
        $result = $link->query($query);
        if (!$result) {
            printf("Errormessage: %s\n", $link->error);
            return false;
        }
        return $result;
	}

function updateRep($idUser, $rep, $creds)
{
    $link = connect();
    if (validateUser($idUser)) {
        $user = getUser($idUser)->fetch_assoc();

        $prevRep = $user['reputation'];
        $newRep = $prevRep + $rep;
        
        $prevCreds = $user['credits'];
        $newCreds = $prevCreds + $creds;

        $query = "UPDATE users SET reputation=$newRep, credits=$newCreds WHERE idUsers=$idUser";
        if ($result = $link->query($query)) {
            return $result;
        }
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function getForRanking(){
    include_once 'connect.php';
    $link = connect();
    $query = "SELECT name, surname, reputation FROM users WHERE admin = 0;";
    $result = $link->query($query);
    if ($result = $link->query($query)) {
        return $result;
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

?>