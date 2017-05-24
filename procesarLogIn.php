<?php 
Include("loginFx.php");
session_start();

userLogin(	$_POST['email'], $_POST['pass']	);

if(isset($_SESSION['idUsers']))
	header("Location: index.php");

else
	header("Location: logIn.php");
?>