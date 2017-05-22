<!DOCTYPE html>
<html lang="en">
  <head>
    <title>unaGauchada</title>
    <?php
      Include("header.php");
    ?>
    <!-- Main jumbotron for a primary marketing message or call to action -->
    <div class="jumbotron fondoGaucho" id="fondoGaucho" style="width:100%;">
      <br><br>
      <div class="container" id="gradOrange">
        <br><br><br><br>
        <img class="col-md-2 img-responsive" src="imgs/logoUnaGauchada.png"><h2 class="titulo" style="font-size:60px;">Bienvenido a #unaGauchada!</h2>
        <p style="font-size:19px;">un sitio en donde podrás contactarte con cualquier persona a lo largo y ancho de todo el país para darle una mano, y también recibir la ayuda de un noble gaucho.
          <br>Ya somos miles y miles los que elegimos ser parte de esta enorme comunidad.
          <br>Qué esperas para sumarte?!</p>
        <br><br>
        <p><a class="btn btn-danger btn-lg" href="gauchadas.php" role="button" style="background-color:black;">Ver gauchadas&raquo;</a></p>
      </div>
    </div>
    <br>

    <div class="container">
    <div class="page-header">
        <h1>Echa un vistazo a los últimos posts:</h1>
      </div>
    </div>
      <br>

    <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4  box html5">
          <h2>Busco acompañante <br>de viaje</h2>
            <p style="font-size:18px;">Soy camionero y busco una persona que me acompañe en mi viaje hasta Rawson porque sufro problemas de sueño. 
            Saldríamos el primer fin de semana de octubre y retornaríamos ...</p>
            <p><a class="btn btn-default" href="detalle.php" role="button">Ver detalle &raquo;</a></p>
        </div>
        <div class="col-md-4 box html5">
          <h2>Reencontrarme con Ramirez</h2>
            <p style="font-size:18px;">Ramirez es un burrito que tenía de mascota en un campo en Tucumán. Quisiera reencontrarme con él pero no puedo moverme por un problema físico. 
            Me gustaría que alguien ...</p>
            <p><a class="btn btn-default" href="detalle.php" role="button">Ver detalle &raquo;</a></p>
       </div>
        <div class="col-md-4 box html5">
          <h2>Restaurar obra de arte arruinada</h2>
           <p style="font-size:18px;">La imagen de la izquierda es la original y la de la derecha mi intento por restaurarla. ¿Alguien me haría la gauchada de ...</p>
          <p><a class="btn btn-default" href="detalle.php" role="button">Ver detalle &raquo;</a></p>
        </div>
      </div>
      <br><br><br><br>
      <div class="page-header">
        <h1>Recuerda</h1>
      </div>
      <div class="well" id="gradOrange">
        <p style="font-size:20px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
        quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
        proident, sunt in culpa qui officia deserunt mollit anim id est laborum..</p>
      </div>
      <br>
      <?php
        Include("footer.html");
      ?>
  </body>
</html>
