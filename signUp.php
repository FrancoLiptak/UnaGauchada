<html>
	<head>
	<title>Sing Up</title>
  <?php 
  include_once "validate.php";
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if (validateLogin()) {
    $_SESSION['msg'] = "No puede ingresar a signUp.php si ya tiene una sesion iniciada.";
    header('Location: index.php');
    die;
  }
  include_once "header.php";
  include_once "alert.php";
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
  include_once "validate.php";

  ?>
    <div class="row">
        <div class="container-fluid col-md-6 col-md-offset-3">
        <div class="page-header">
          <h4 style="text-align:center;"> <strong>Recuerda:</strong> necesitas ser mayor de 18 años para poder registrarte! <br>
          No olvides completar los campos obligatorios marcados con un "<span class="glyphicon glyphicon-bookmark"></span>". </h4> 
        </div>
    </div>
    <?php
       /* a continuacion van todas las validaciones en php ... */
        if (isset($_SESSION['msg']) && $_SESSION['msg'] != "" ) {
          hacerAlert($_SESSION['msg']);
          $_SESSION['msg'] = "";
        }
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

       <form enctype="multipart/form-data" class="col-md-4 col-md-offset-4" action="procesarSignUp.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on" name="signUp_form" onsubmit="return validateFormSignUp()">
    			<div class="row ">
            <div class="form-group col-md-6">
                <label><span class="glyphicon glyphicon-bookmark"></span> Nombre:</label>
                <input class="form-control" type="text" name="name" placeholder=" Nombre" required>
          	</div>
          	<div class="form-group col-md-6">
                <label><span class="glyphicon glyphicon-bookmark"></span> Apellido:</label>
                <input class="form-control" type="text" name="surname" placeholder=" Apellido"required>
       			</div>
          </div> <!-- fin row -->
    			<div class="form-group">
            <label><span class="glyphicon glyphicon-bookmark"></span> Email:</label>
            <input class="form-control" type="email" name="email" placeholder=" E-mail"required>
    			</div>
          <div class="row ">
        			<div class="form-group col-md-6">
                <label><span class="glyphicon glyphicon-bookmark"></span> Teléfono: <span class="form-note">(Sólo numeros)</span></label>
                <input class="form-control" type="tel" name="phone" placeholder=" Teléfono"required>
              </div>
              <div class="form-group col-md-6">
                  <label><span class="glyphicon glyphicon-bookmark"></span> Fecha de Nacimiento:</label>
                  <?php  
                    $fecha = date('Y-m-d');
                    $nuevafecha = strtotime ( '-18 year' , strtotime ( $fecha ) ) ;
                    $nuevafecha = date ( 'Y-m-j' , $nuevafecha );
                   ?>
                 <input class="form-control" type="date" name="birthDate" max="<?php echo $nuevafecha;?>" min="1917-05-26"required>
        			</div>
          </div> <!-- fin row -->
          <div class="row ">
        			<div class="form-group col-md-6">
                <label><span class="glyphicon glyphicon-bookmark"></span> Contraseña: <span class="form-note">(Maximo 20 chars)</span></label>
                <input class="form-control" type="password" name="pass1" placeholder=" Contraseña" onfocus="nota()"required>
        			</div>
              <div class="form-group col-md-6">
                <label><span class="glyphicon glyphicon-bookmark"></span> Confirmar contraseña:</label>
        			  <input class="form-control" type="password" name="pass2" placeholder=" Comfirmar contraseña"required>
        		 </div>
          </div> <!-- fin row -->
          <div class="form-group">
              <label for="file"> Imagen: <span class="form-note">(El archivo debe ser menor a 15 MB, en formato JPG, JPEG o PNG)</span></label> 
              <input type="file" class="form-control filestyle" name="file" id="file" data-buttonText=" Selecciona una imágen" data-placeholder="No hay ninguna img cargada">
          </div>
    		  <input type="submit" name="submit" id="submit" class="btn btn-warning center-block" value="Sign up">
			 </form>
  	</div>
<!----------------------------------- Script para validar el Sign Up -->
  <script rel="text/javascript" src="js/signUp.js"></script>
  <?php Include("footer.html"); ?>
  </body>
</html>
