<?php

function getVentas($end = null, $start = null) {
	include_once "connect.php";
	include_once "usersFx.php";

	if (is_null($end)) {
		$end = date("Y-m-d");
	}
	else {
		$end = date("Y-m-d", strtotime($end));
	}

	$end = new DateTime($end);
	$end->add(new DateInterval('P1D'));
	$end = $end->format('Y-m-d H:m:s');

	if (is_null($start)) {
		$start = date("Y-m-d", strtotime("last month"));
	}
	else {
		$start = date("Y-m-d", strtotime($start));
	}

	$link = connect();
	$query = "SELECT * FROM purchases WHERE date >= '$start' AND date <= '$end'";
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
		$venta['fechaHora'] = $current['date'];
		$ventas[] = $venta;
	}

	return $ventas;
}

function registerPurchase($user, $creds){
	include_once 'connect.php';
	include_once 'credits.php';

	$link = connect();
	$price = creditValue();
	$date = date("Y-m-d H:i:s");

	$query = "INSERT INTO purchases (idUser, quantity, price, date)";
	$query = $query."VALUES ($user, $creds, $price, '$date')";
	if ($result = $link->query($query)) {
		return $result;
	}
	$_SESSION['msg'] = $link->error;
	return false;

}

?>