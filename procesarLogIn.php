<?php 
Include("loginFx.php"); 
userLogin($_POST['email'], $_POST['pass']);
if (!(	userLogin($_POST['email'], $_POST['pass'])	)){ 
	$_SESSION['mal']='mal';
	header("Location: logIn.php");
}


?>



