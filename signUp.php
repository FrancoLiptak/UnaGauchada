<html>
	<head>
	<title>Sing Up</title>
  <?php 
  include_once "header.php";
  include_once "alert.php";
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
  include_once "validate.php";
  if (validateLogin()) {
		$_SESSION['msg'] = "No puede ingresar a signUp.php si ya tiene una sesion iniciada.";
		header('Location: index.php');
        die;
  }

  ?>
    <div class="row">
        <div class="container-fluid col-md-4 col-md-offset-4">
         <br><br><br>
        <div class="page-header">
          <h4 style="text-align:center;"> No olvides completar los campos. Son todos de carácter obligatorio. </h4> 
        </div>
        <br>
    </div>
    <?php
       /* a continuacion van todas las validaciones en php ... */
       if(isset($_SESSION['registrado'])){ 
           hacerAlert($_SESSION['registrado'], "success");
           unset($_SESSION['registrado']);
       }
       else if(isset($_SESSION['otro_email'])){
          hacerAlert($_SESSION['otro_email']); //la sesion guarda el mensaje de alerta.
          unset($_SESSION['otro_email']);
       } 
       else if(isset($_SESSION['mal_completado'])){
          hacerAlert($_SESSION['mal_completado']);
          unset($_SESSION['mal_completado']);
       } ?>

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
  </body>
</html>
