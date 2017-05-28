<!DOCTYPE html>
<html lang="en">
  <head>
    <title>unaGauchada</title>
    <?php
      include_once "header.php";
      include_once "alert.php";
      include_once 'validate.php';
      include_once 'gauchadasFx.php';
    ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->

    <div class="jumbotron fondoGaucho" id="" style="width:100%;">
      <br><br>
      <div class="container" id="fondoGris">
        <?php
              if (isset($_SESSION['msg']) && $_SESSION['msg'] != "" ) {
                hacerAlert($_SESSION['msg']);
                $_SESSION['msg'] = "";
              }
              elseif (isset($_SESSION['success']) && $_SESSION['success'] != "" ) {
                hacerAlert($_SESSION['success'],'success');
                $_SESSION['success'] = "";
              }
        ?>
        <div class="col-md-10">
          <h2 style="">Bienvenido a unaGauchada!</h2>
          <p style="font-size:19px;">Un sitio en donde podrás contactarte con cualquier persona a lo largo y ancho de todo el país para darle una mano, y también recibir la ayuda de un noble gaucho.
            <br>Ya somos miles y miles los que elegimos ser parte de esta enorme comunidad.
            <br>Qué esperas para sumarte?!</p>
        </div>
        <img class="col-md-2 img-responsive" src="imgs/logoUnaGauchada.png">
      </div> <!-- fondo transparente -->
    </div> <!-- jumbotron fondoGaucho -->
    <div class="row">
    <div class="container">
    <div class="page-header">
        <h2>Echa un vistazo a los últimos posts:</h2>
    </div>
    </div>
    </div>
    <?php 
      $gauchadas = getGauchadas(3,0);
      $i = $gauchadas->num_rows;
     ?>
    <div class="col-md-12">
            <div class="container">
                <div class="row">
                    <?php
                    while ($i > 0) {
                        showGauchadaForAllPrueba($gauchadas->fetch_assoc());
                        $i--;
                    }
?>
                </div>
            </div>
    </div>
    <br clear="all">
    <div class="row">
      <div class="container">
        <div class="page-header">
          <h2>Visualiza todas las publicaciones hasta el momento y comienza a participar! <a href="gauchadas.php" class="center-block btn btn-info" style="display:inline;" id="ver"><span class="glyphicon glyphicon-globe"></span> Gauchadas &raquo;</a></h2>
          
        </div>
      </div>
    </div>
      <br clear="all">
      <div class="well container" style="text-align:center;">
        <p style=""><span class="glyphicon glyphicon glyphicon-envelope" aria-hidden="true"> Email:</span><span id="mail"> nancy.netramanti@unaGauchada.com</span><span class="glyphicon glyphicon glyphicon-phone-alt" aria-hidden="true"> Teléfono:</span> 4720996</p>
      </div>
      <?php
        Include("footer.html");
      ?>
  </body>
</html>
