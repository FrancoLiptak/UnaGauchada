<html>
	<head>
	<title>Sing Up</title>
  <?php Include("header.php");
  session_start();?>
  		<div class="row">
        <div class="container-fluid col-md-4 col-md-offset-4">
         <br><br><br>
        <div class="page-header">
          <h4 style="text-align:center;"> No olvides completar los campos. Son todos de carácter obligatorio. </h4> 
        </div>
        <br>
    </div>
       <?php Include("alert.php");
       /* a continuacion van todas las validaciones en php ... alto quilombo ya lo se */
       if(isset($_SESSION['registrado'])){ 
            hacerAlert("Se ha realizado el Sign up con éxito!", "success"); ?>
            <br>
            </div>      
            <a onclick="<?php $array_reg=explode('/',$_SESSION['registrado']); $_SESSION['email_registrado']=$array_reg[0];$_SESSION['pass_registrado']=$array_reg[1]; ?>" class="col-md-6 col-md-offset-3 link" href="logIn.php"><i class="fa fa-users" aria-hidden="true" style="color:#00A388;"></i>  LOG IN  </a>
            <br>
           <?php
           unset($_SESSION['registrado']);
       }
       else if(isset($_SESSION['otro_email'])){
          hacerAlert("Ingesa otro email. Ese email ya existe!");
          unset($_SESSION['otro_email']);
       } 
       else if(isset($_SESSION['no_registrado'])){
          hacerAlert("Error al registrar.");
          unset($_SESSION['no_registrado']);
       } 
       else if(isset($_SESSION['mal_completado'])){
          hacerAlert("Verifica si has completado todos los campos. Son de caracter obligatorio!<br>También recuerda que deben coincidir las passwords...");
          unset($_SESSION['mal_completado']);
       } ?>
       <br><br><br><br><br><br><br><br>
       <form class="col-md-2 col-md-offset-5" action="procesarSignUp.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on" name="signUp_form" onsubmit="return validateFormSignUp()">
    			<input class="form-control" type="text" name="name" placeholder=" Nombre..." required>
    			<br>
    			<input class="form-control" type="text" name="surname" placeholder=" Apellido..."required>
    			<br>
    			<input class="form-control" type="email" name="email" placeholder=" E-mail..."required>
    			<br>
    			<input class="form-control" type="tel" name="phone" placeholder=" Teléfono..."required>
          <br>
          <input class="form-control" type="date" name="birthDate" required>
    			<br>
    			<input class="form-control" type="password" name="pass1" placeholder=" Password..." onfocus="nota()"required>
    			<br>
    			<input class="form-control" type="password" name="pass2" placeholder=" Comfirmar password..."required>
    			<br><br>
    		  <input type="submit" name="submit" class="btn btn-warning center-block" value="Sign up">
			 </form>
			 <br><br>
  	</div>
<!----------------------------------- Script para validar el Sign Up -->
  <script rel="text/javascript" src="js/signUp.js"></script>
  <?php Include("footer.html"); ?>
</html>
