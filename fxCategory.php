<?php

    function getCategory($idCate) {

		$link = connect();
		$query = "SELECT * FROM category WHERE idCategory = $idCate;";
        $result = $link->query($query);
        if (!$result) {
            printf("Errormessage: %s\n", $link->error);
            return false;
        }
		return $result;
	}

    function getCategories(){
        // Retorna las categorias
        $link = connect();
        $query = "SELECT * FROM category ";
        if ($result = $link->query($query)) {
            return $result;
        }
        $_SESSION['msg'] = $link->error;
        return false;
    }

?>