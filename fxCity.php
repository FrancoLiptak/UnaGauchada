<?php

    function getCity($idCity) {
		// Retorna las proximas $limit gauchadas comenzando desde la tupla numero $first que cumplen la condicion $condition.

		$link = connect();
		$query = "SELECT * FROM city WHERE idCity = $idCity;";
        $result = $link->query($query);
        if (!$result) {
            printf("Errormessage: %s\n", $link->error);
            return false;
        }
		return $result;
	}

?>