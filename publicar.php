<html>
	<head>
	<title>Publicar gauchada</title>
  <?php 
    include_once "header.php";
    include_once "doSelect.php";
    include_once "validate.php";
    session_start();
    if (!validateLogin()) {
        $_SESSION['msg'] = "No puede ingresar a publicar.php sin antes iniciar sesion.";
        header('Location: index.php');
        die;
    }
  ?>
  </head>
<br>
<br>
  	<div class="row">
  			<?php 
         Include("alert.php");
        if(isset($_SESSION['mal_tamaño'])){
          hacerAlert("No se ha podido publicar su gauchada ya que la foto elegida excede los 65.536Bytes.");
          unset($_SESSION['mal_tamaño']);
        }
				if(isset($_SESSION['mal_completado'])){
           hacerAlert("No se ha podido publicar su gauchada ya que no se han completado todos los campos.");
           unset($_SESSION['mal_completado']);
        } 
        
        include_once "connect.php"; 
        $link=connect();
        
  			?>
        <br><div class="container">
<form class="col-md-2 col-md-offset-5" action="procesarPublicar.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on" name="publucar_form" onsubmit="return validateFormPublicar()">
  <div class="form-group">
    <label for="title">Titulo:</label>
    <input type="text" class="form-control" id="title" name="title">
  </div>
  <div class="form-group">
    <label for="description">Description:</label>
    <input type="text-area" class="form-control" id="description" name="description">
  </div>
  <div class="form-group">
    <label for="expiration">Fecha limite:</label>
    <input type="date" class="form-control" id="expiration" name="expiration">
  </div>
  <div class="form-group">
    <label for="category">Categoria:</label>
    <select class="form-control" id="category" name="category">
        <?php selectCates(); ?>
    </select>
  </div>
  <div class="form-group">
    <label for="city">Ciudad:</label>
    <select class="form-control" id="city" name="city">
        <?php selectCity(); ?>
    </select>
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form> </div>
			<br><br><br>
  		

  	</div> <!-- fin row -->
 

   <!-------------------------------------------- Script para validar el publicar -->
  <script rel="text/javascript" src="js/publicar.js"></script>

  <?php Include("footer.html"); ?>
 </body>
</html>
