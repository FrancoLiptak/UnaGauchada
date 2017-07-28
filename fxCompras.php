<?php

function getVentas($end = null, $start = null) {
	include_once "connect.php";
	include_once "usersFx.php";

	if (is_null($end)) {
		$end = date("y-m-d");
	}
	else {
		$end = date("y-m-d", $end);
	}

	if (is_null($start)) {
		$start = date("y-m-d", strtotime("last month"));
	}
	else {
		$start = date("y-m-d", $start);
	}
	
	$link = connect();
	$query = "SELECT * FROM purchases WHERE date > '$start' AND date < '$end'";
	if (!$result = $link->query($query)) {
		$_SESSION['msg'] = $link->error;
		return false;
	}

	$ventas = array();
	while ($current = $result->fetch_assoc()) {
		$user = getUser($current['idUser'])->fetch_assoc();
		$venta['nombre'] = $user['name'];
		$venta['apellido'] = $user['surname'];
		$venta['cantidad'] = $current['quantity'];
		$venta['monto'] = $current['quantity'] * $current['price'];
		$ventas[] = $venta;
	}

	return $ventas;
}

?>