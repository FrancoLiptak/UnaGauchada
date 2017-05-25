<?php
	
	function connect() {
		// Retorna un link con la base de datos. Completar con los datos de la base de datos en uso.

		$link = mysqli_connect('localhost', 'root', '12345', 'grupo07')
		or die("Error " . mysqli_error($link));

		return $link;
	}

?>