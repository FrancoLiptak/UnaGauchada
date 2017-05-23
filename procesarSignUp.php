<?php 
Include("newUser.php"); 

newUser($_POST['email'], $_POST['pass1'], $_POST['pass2'], $_POST['name'], $_POST['surname'], $_POST['birthDate'], $_POST['phone']) ;

header("Location: signUp.php");

?>
