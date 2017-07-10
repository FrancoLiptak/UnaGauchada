<html>

<head>
  <title>Editar gauchada</title>
  <?php
  include_once "validate.php";
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if (!(validateLogin())) {
    $_SESSION['msg'] = "No puede ingresar a editarGauchada.php si no tiene una sesion iniciada.";
    header('Location: index.php');
    die;
  }
  if (isAdmin()) {
    $_SESSION['msg'] = "No puede ingresar a editarGauchada.php si es administrador.";
    header('Location: index.php');
    die;
  }
    include_once "header.php";
    include_once "doSelect.php";
    include_once "gauchadasFx.php";
    ?>
</head>
<div class="row">
    <div class="container-fluid col-md-6 col-md-offset-3 ph">
    <div class="page-header">
      <h4 style="text-align:center;">Editar Gauchada</h4> 
    </div>
</div>
    <?php
            include_once("alert.php");
    if (isset($_SESSION['mal_tamaño'])) {
        hacerAlert("No se ha podido editar su gauchada ya que la foto elegida excede los 65.536Bytes.");
        unset($_SESSION['mal_tamaño']);
    }
    if (isset($_SESSION['mal_completado'])) {
        hacerAlert("No se ha podido editar su gauchada ya que no se han completado todos los campos.");
        unset($_SESSION['mal_completado']);
    }

    include_once "connect.php";
    $link=connect();
    $gauchada= getOneGauchada($_GET["id"]);

    ?>
    <form enctype="multipart/form-data" class="col-md-4 col-md-offset-4" action="procesarEditarGauchada.php" method="post" target="_self"
      accept-charset="UTF-8" autocomplete="on" name="publicar_form" onsubmit="return validateFormEditarGauchada()">
      <div class="row">
                <div class="form-group col-md-6">
                    <label>Foto de perfil:</label>
                    <div class="input-group">
                        <span class="input-group-btn">
                            <span class="btn btn-default btn-file">
                                Actualizar <input type="file" id="imgInp">
                            </span>
                        </span>
                        <input type="text" class="form-control" readonly>
                    </div>
                    <img id='img-upload' src= <?php echo $gauchada['image']; ?>/>
                </div>
      
                <div class="form-group col-md-6">
                  <label for="description"><span class="glyphicon glyphicon-bookmark"></span> Descripción:</label>
                  <textarea class="form-control" id="description" rows="10" name="description" placeholder="Descripcion" required><?php echo $gauchada["description"];?> </textarea>
                </div>    
                <br clear="all">    
                <div class="form-group">
                  <label for="title"><span class="glyphicon glyphicon-bookmark"></span> Título:</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Titulo" value="<?php echo $gauchada["title"];?>" required>
                </div>
                
                <div class="form-group">
                  <label for="expiration"><span class="glyphicon glyphicon-bookmark"></span> Fecha limite:</label>
                  <input type="date" class="form-control" id="expiration" name="expiration" min="<?php echo date('Y-m-d');?>" value="<?php echo $gauchada["expiration"];?>" required>
                </div>
                <div class="row ">
                  <div class="form-group col-md-6">
                    <label for="category"><span class="glyphicon glyphicon-bookmark"></span> Categoria:</label>
                    <select class="form-control example" id="category" name="category">
                                  <?php selectCates(); ?>
                            </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="city"><span class="glyphicon glyphicon-bookmark"></span> Ciudad:</label>
                    <select class="form-control example" id="city" name="city">
                                  <?php selectCity(); ?>
                            </select>
                  </div>
          </div>
          <!-- row -->
          <input type="submit" name="submit" id="submit" value="Guardar cambios" class="center-block btn btn-warning">
    </form>

</div>
<!-- fin row -->


<!-------------------------------------------- Script para validar el publicar -->
<script rel="text/javascript" src="js/imagePreviewer.js"></script>

<script rel="text/javascript" src="js/publicar.js"></script>

<?php include("footer.html"); ?>
</body>

</html>
