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

?>