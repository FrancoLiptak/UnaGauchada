<?php 
Include("newUser.php"); 

if (newUser($_POST['email'], $_POST['pass1'], $_POST['pass2'], $_POST['name'], $_POST['surname'], $_POST['birthDate'], $_POST['phone'], $_FILES['file'])) {
    include_once 'loginFx.php';
    userLogin($_POST['email'], $_POST['pass1']);
    header ("Location: index.php");
    die;
}

header("Location: signUp.php");
die;
?>
