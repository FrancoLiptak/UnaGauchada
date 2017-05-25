<?php

	include_once 'connect.php';
    include_once 'usersFx.php';
    include_once 'fxCategory.php';
    include_once 'fxCity.php';
	function getGauchadas($limit, $first, $condition = "1 = 1") {
		// Retorna las proximas $limit gauchadas comenzando desde la tupla numero $first que cumplen la condicion $condition.

		$link = connect();
		$query = "SELECT * FROM gauchadas WHERE " . $condition . " LIMIT $first, $limit";
        $result = $link->query($query);
        if (!$result) {
            printf("Errormessage: %s\n", $link->error);
            return false;
        }
		return $result;
	}

	function getOneGauchada($idGauchadas) {
		// Retorna la gauchada con idGauchada = $idGauchada.

		return getGauchadas(1, 1, "idGauchadas = $idGauchadas");
	}

    function showGauchadaForAll($gauchada) {
        $user = (getUser($gauchada['idUser']))->fetch_assoc();
        $cate = getCategory($gauchada['idCategory'])->fetch_assoc();
        $city = getCity($gauchada['idCity'])->fetch_assoc();
        $hoy = date("Y-m-d");

        ?>

        <p>Creada por: <?php echo $user['name']; ?></p>
        <?php // Falta imagen Usuario ?>
        <p>Categoria: <?php echo $cate['name']; ?></p>
        <p>Ciudad: <?php echo $city['name']; ?></p>
        <p>Titulo: <?php echo $gauchada['title']; ?></p>
        <p>Descripcion: <?php echo $gauchada['description']; ?></p>
        <p>Faltan <?php echo date_diff(date_create($gauchada['expiration']), date_create($hoy))->format('%a') ?> dias para que esta gauchada expire</p>
        <?php // Falta imagen Gauchada ?>
        <?php //<a href=""></a>    LINK A VER GAUCHADA INDIVIDUAL   ?>
        <?php
        
    }
?>