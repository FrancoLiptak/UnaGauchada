<?php

include_once "connect.php";
include_once "usersFx.php";

function getVentas($end = null, $start = null) {

	if (is_null($start)) {
		if (is_null($end)) {
			$end = date("y-m-d");
		}
		$start = date("y-m-d", strtotime("last month"));
	}
	
	$link = connect();
	$query = "SELECT * FROM purchases WHERE date > '$start' AND date < '$end'";
	if ($result = $link->query($query)) {
		return $result;
	}
	$_SESSION['msg'] = $link->error;
	return false;

}

$result = getVentas();
$ventas = array();
while ($current = $result->fetch_assoc()) {
	$user = getUser($current['idUser'])->fetch_assoc();
	$venta['nombre'] = $user['name'];
	$venta['apellido'] = $user['surname'];
	$venta['cantidad'] = $current['quantity'];
	$venta['monto'] = $current['quantity'] * $current['price'];
	$ventas[] = $venta;
}

?>