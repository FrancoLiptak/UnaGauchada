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
        $query = "SELECT * FROM category ORDER BY name ASC";
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
        $_SESSION['success'] = "La categoria $name se creo correctamente.";
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

function deleteCategoryFisico($id){
    /* falta diferenciar entre borrado logico y fisico */
    $link = connect();
    $name= mysqli_fetch_assoc(getCategory($id))['name'];
    $query = "DELETE FROM category WHERE idCategory=$id;";
    if ($result = $link->query($query)) {
        $_SESSION['success'] = "La categoria $name ha eliminado de forma permanente.";
        return $result;
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function deleteCategoryLogico($id){
    /* falta diferenciar entre borrado logico y fisico */
    $link = connect();
    $name= mysqli_fetch_assoc(getCategory($id))['name'];
    $query = "UPDATE category SET deleted=1 WHERE idCategory=$id;";
    if ($result = $link->query($query)) {
        $_SESSION['success'] = "La categoria $name ya no podrá ser elegida al publicar pero sí podrá ser buscada para ver sus gauchadas asociadas.";
        return $result;
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function editCategory($id, $name){
    $link = connect();
    $oldCat= mysqli_fetch_assoc(getCategory($id))['name'];
    $query = "UPDATE category SET name='$name' WHERE idCategory=$id;";
    if ($result = $link->query($query)) {
        $_SESSION['success'] = "La categoria $oldCat se modifico correctamente.<br> Nuevo nombre: $name.";
        return $result;
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function cateByName($name) {
    $link = connect();
    $query = "SELECT * FROM category WHERE name = '$name'";
    if ($result = $link->query($query)) {
        return $result->fetch_assoc();
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function activateCate($id) {
    $link = connect();
    $query = "UPDATE category SET deleted=0 WHERE idCategory=$id;";
    if ($result = $link->query($query)) {
        return $result;
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function cateHasGauchadas($id) {
    $link = connect();
    $query = "SELECT * FROM gauchadas WHERE idCategory = $id";
    if ($result = $link->query($query)) {
        return $result->num_rows >= 1;
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

?>