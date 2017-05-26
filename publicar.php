<html>
	<head>
	<title>Publicar gauchada</title>
  <?php
    include_once "header.php";
    include_once "doSelect.php";
    include_once "validate.php";
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
          <h4 style="text-align:center;">
            Completa el siguiente formulario para realizar la publicación. No olvides completar los campos obligatorios marcados con un "<span class="glyphicon glyphicon-bookmark"></span>".</h4> 
        </div>
    </div>
            <?php
            include("alert.php");
            if (isset($_SESSION['mal_tamaño'])) {
                  hacerAlert("No se ha podido publicar su gauchada ya que la foto elegida excede los 65.536Bytes.");
                  unset($_SESSION['mal_tamaño']);
            }
            if (isset($_SESSION['mal_completado'])) {
                hacerAlert("No se ha podido publicar su gauchada ya que no se han completado todos los campos.");
                unset($_SESSION['mal_completado']);
            }
        
            include_once "connect.php";
            $link=connect();
        
            ?>
        <form enctype="multipart/form-data" class="col-md-4 col-md-offset-4" action="procesarPublicar.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on" name="publucar_form" onsubmit="return validateFormPublicar()">
            <div class="form-group">
              <label for="title"><span class="glyphicon glyphicon-bookmark"></span> Título:</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="Titulo">
            </div>
            <div class="form-group">
              <label for="description"><span class="glyphicon glyphicon-bookmark"></span> Descripción:</label>
              <textarea class="form-control" id="description" name="description" placeholder="Descripcion"></textarea>
            </div>
            <div class="form-group">
              <label for="expiration"><span class="glyphicon glyphicon-bookmark"></span> Fecha limite:</label>
              <input type="date" class="form-control" id="expiration" name="expiration" min="<?php echo date('Y-m-d');?>">
            </div>
            <div class="row ">
                  <div class="form-group col-md-6">
                    <label for="category"><span class="glyphicon glyphicon-bookmark"></span> Categoria:</label>
                    <select class="form-control" id="category" name="category">
                      <?php selectCates(); ?>
                  </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="city"><span class="glyphicon glyphicon-bookmark"></span> Ciudad:</label>
                    <select class="form-control" id="city" name="city">
                      <?php selectCity(); ?>
                  </select>
                  </div>
            </div> <!-- row -->
            <div class="form-group">
              <label for="file"> Imagen: <span style="color:red; font-size:10px; font-family:'Montserrat', sans-serif;">( el tamaño del archivo debe ser menor igual a 15 MB)</span></label> 
              <input type="file" class="form-control filestyle" name="file" id="file" data-buttonText=" Selecciona una imágen" data-placeholder="No hay ninguna img cargada">
            </div>
            <input type="submit" name="submit" id="submit" value="Publicar" class="center-block btn btn-warning">
        </form>

    </div> <!-- fin row -->
 

   <!-------------------------------------------- Script para validar el publicar -->
  <script rel="text/javascript" src="js/publicar.js"></script>

    <?php include("footer.html"); ?>
 </body>
</html>
