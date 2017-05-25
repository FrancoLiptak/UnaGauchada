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
    <div class="row">
    <div class="container-fluid  col-md-4 col-md-offset-4">
        <div class="page-header">
          <h4 style="text-align:center;"> <strong>Recuerda:</strong> necesitas créditos para poder publicar! 
            Completa el siguiente formulario para realizar la publicación. No olvides completar los campos obligatorios marcados con un "<span class="glyphicon glyphicon-bookmark"></span>".</h4> 
        </div>
    </div>
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
        <form enctype="multipart/form-data" class="col-md-4 col-md-offset-4" action="procesarPublicar.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on" name="publucar_form" onsubmit="return validateFormPublicar()">
            <div class="form-group">
              <label for="title"><span class="glyphicon glyphicon-bookmark"></span> Título:</label>
              <input type="text" class="form-control" id="title" name="title">
            </div>
            <div class="form-group">
              <label for="description"><span class="glyphicon glyphicon-bookmark"></span> Descripción:</label>
              <input type="text-area" class="form-control" id="description" name="description">
            </div>
            <div class="form-group">
              <label for="expiration"><span class="glyphicon glyphicon-bookmark"></span> Fecha limite:</label>
              <input type="date" class="form-control" id="expiration" name="expiration">
            </div>
            <div class="form-group">
              <label for="category"><span class="glyphicon glyphicon-bookmark"></span> Categoria:</label>
              <select class="form-control" id="category" name="category">
                <?php selectCates(); ?>
            </select>
            </div>
            <div class="form-group">
              <label for="city"><span class="glyphicon glyphicon-bookmark"></span> Ciudad:</label>
              <select class="form-control" id="city" name="city">
                <?php selectCity(); ?>
            </select>
            </div>
            <input type="submit" name="submit" id="submit" value="Publicar" class="center-block btn btn-warning">
        </form>

  	</div> <!-- fin row -->
 

   <!-------------------------------------------- Script para validar el publicar -->
  <script rel="text/javascript" src="js/publicar.js"></script>

  <?php Include("footer.html"); ?>
 </body>
</html>
