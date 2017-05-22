<html>
	<head>
	<title>Log In</title>
  <?php Include("header.php");?>
  <br>
  <div class="row">
    <div class="container-fluid  col-md-4 col-md-offset-4">
         <br><br><br>
        <div class="page-header">
          <h4 style="text-align:center;"> Si aún no te has <a href="signUp.php">registrado</a>, no dudes en hacerlo. </h4> 
        </div>
        <br>
    </div>
  			<?php  /* por si ocurre algun error al loguearse */
				Include("alert.php");
        if(isset($_SESSION['mal'])){ 
            hacerAlert("Verifica si te has registrado previamente en el sistema, o bien si el email y la contraseña que ingresaste son correctos.");
            unset($_SESSION['mal']); 
        }?>
       <br><br><br><br><br><br>
  			<form class="col-md-2 col-md-offset-5" action="procesarLogIn.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on" name="logIn_form" onsubmit="return validateFormLogIn()">
          <input class="form-control" type="email" value="<?php /*lo de aca era un invento mio para que cuando un usuario se registra correctamente y es redireccionado al login,
          que se llenen automaticamente los campos de email y pass con los que puso recien al registrarse.*/
          if(isset($_SESSION['email_registrado'])) echo $_SESSION['email_registrado'];?>" name="email" placeholder=" E-mail...">
          <br><br>
    			<input class="form-control" type="password" value="<?php if(isset($_SESSION['pass_registrado'])) echo $_SESSION['pass_registrado'];?>" name="pass" placeholder=" Contraseña...">
    			<br><br><br>
          <input type="submit" name="submit" value="Log in" class=" center-block btn btn-warning">
			 </form>
			<br><br><br>
  	</div> <!-- Cierro row -->
 <!-------------------------------------------- Script para validar el login -->
  <script rel="text/javascript" src="js/logIn.js"></script>
 
  <?php 
  /* borra esas sesiones que tienen el email y la pass de la ultima persona que se registró.*/
  /*if(isset($_SESSION['email_registrado'])) unset($_SESSION['email_registrado']);
   if(isset($_SESSION['pass_registrado'])) unset($_SESSION['pass_registrado']);*/
  
   Include("footer.html"); ?>
 </body>
</html>
