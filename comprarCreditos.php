<html>
	<head>
	<title>Comprar créditos</title>
  <?php Include("header.php");
  Include("alert.php");
  include_once "validate.php";
  if (!validateLogin()) {
		$_SESSION['msg'] = "No puede ingresar a comprarCreditos.php sin antes iniciar sesion.";
		header('Location: index.php');
        die;
  }

  ?>
  <br>
  <div class="row">
    <div class="container-fluid  col-md-4 col-md-offset-4">
         <br><br><br>
        <div class="page-header">
          <h4 style="text-align:center;"> <strong>Recuerda:</strong> necesitas créditos para poder publicar! 
            Completa el siguiente formulario para realizar la compra. No olvides completar con tus datos de tarjeta. Es la única forma de poder efectuar la transaccion. </h4> 
        </div>
        <br>
    </div>
		<?php  /* por si ocurre algun error al comprar */
    if(isset($_SESSION['errorEnCompra'])){
        hacerAlert($_SESSION['errorEnCompra']);
        unset($_SESSION['errorEnCompra']); 
    }
    elseif(isset($_SESSION['bien'])){
        hacerAlert($_SESSION['bien'], "success");
        unset($_SESSION['bien']); 
    }
    elseif(isset($_SESSION['mal_completado'])){
        hacerAlert($_SESSION['mal_completado']);
        unset($_SESSION['mal_completado']); 
    }?>
     
		<form class="col-md-2 col-md-offset-5" action="procesarComprar.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on">
      <label>Créditos a comprar</label>&nbsp;
      <input class="form-control" type="number" name="credits" placeholder="Cantidad de créditos" title="50 ARS c/u" required>
      <br>
      <label>Numero de tarjeta</label>&nbsp;
      <input class="form-control" type="number" name="nro" placeholder="Numero de tarjeta" required>
      <br>
      <label>Contraseña de tarjeta</label>&nbsp;
      <input class="form-control" type="password" name="pass" placeholder="Contraseña de tarjeta" required>
      <br>
      <input type="submit" name="submit" value="Comprar" class=" center-block btn btn-warning">
	 </form>
  </div> <!-- Cierro row -->
 
 <!-------------------------------------------- Script para validar el login -->
  <script rel="text/javascript" src=""></script>
 
  <?php 
  Include("footer.html"); ?>
 </body>
</html>
