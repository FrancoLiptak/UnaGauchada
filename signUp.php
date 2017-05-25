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
        <div class="container-fluid col-md-6 col-md-offset-3">
        <div class="page-header">
          <h4 style="text-align:center;"> <strong>Recuerda:</strong> necesitas ser mayor de 18 años para poder registrarte! <br>
           No olvides completar los campos. Son todos de carácter obligatorio. </h4> 
        </div>
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

       <form class="col-md-4 col-md-offset-4" action="procesarSignUp.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on" name="signUp_form" onsubmit="return validateFormSignUp()">
    			<div class="row ">
            <div class="form-group col-md-6">
                <label> Nombre:</label>
                <input class="form-control" type="text" name="name" placeholder=" Nombre..." required>
          	</div>
          	<div class="form-group col-md-6">
                <label> Apellido:</label>
                <input class="form-control" type="text" name="surname" placeholder=" Apellido..."required>
       			</div>
          </div> <!-- fin row -->
    			<div class="form-group">
            <label> Email:</label>
            <input class="form-control" type="email" name="email" placeholder=" E-mail..."required>
    			</div>
    			<div class="form-group">
            <label> Teléfono:</label>
            <input class="form-control" type="tel" name="phone" placeholder=" Teléfono..."required>
          </div>
          <div class="form-group">
              <label> Fecha de Nacimiento:</label>
             <input class="form-control" type="date" name="birthDate" min="1998-01-01" required>
    			</div>
          <div class="row ">
        			<div class="form-group col-md-6">
                <label> Contraseña:</label>
                <input class="form-control" type="password" name="pass1" placeholder=" Password..." onfocus="nota()"required>
        			</div>
              <div class="form-group col-md-6">
                <label> Confirmar contraseña:</label>
        			  <input class="form-control" type="password" name="pass2" placeholder=" Comfirmar password..."required>
        		 </div>
          </div> <!-- fin row -->
    		  <input type="submit" name="submit" id="submit" class="btn btn-warning center-block" value="Sign up">
			 </form>
  	</div>
<!----------------------------------- Script para validar el Sign Up -->
  <script rel="text/javascript" src="js/signUp.js"></script>
  <?php Include("footer.html"); ?>
  </body>
</html>
