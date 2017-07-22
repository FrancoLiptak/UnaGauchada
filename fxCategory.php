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

function newCategory($name){
    $name = trim($name);
    if (!validate($name)) {
        return false;
    }
    $link = connect();
    $query = "INSERT INTO category (name)";
    $query = $query."VALUES ('$name')";
    if ($result = $link->query($query)) {
        $_SESSION['msg'] = "La categoria $name se creo correctamente.";
        return $result;
    }
    $_SESSION['msg'] = $link->error;
}

function cateExists($name) {
    $link = connect();
    $query = "SELECT name FROM category WHERE name = '$name'";
    if ($result = $link->query($query)) {
        return $result->num_rows == 1;
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function deleteCategory($id){
    $link = connect();
    $query = "UPDATE category SET deleted=1 WHERE idCategory=$id;";
    if ($result = $link->query($query)) {
        $_SESSION['msg'] = "La categoria $id se elimino correctamente.";
        return $result;
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function editCategory($id, $name){
    $link = connect();
    $query = "UPDATE category SET name='$name' WHERE idCategory=$id;";
    if ($result = $link->query($query)) {
        $_SESSION['msg'] = "La categoria $id se modifico correctamente. Nuevo nombre: $name.";
        return $result;
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

?>