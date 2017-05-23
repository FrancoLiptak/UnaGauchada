<html>
	<head>
	<title>Log In</title>
  <?php Include("header.php");
  Include("alert.php");
  ?>
  <br>
  <div class="row">
    <div class="container-fluid  col-md-4 col-md-offset-4">
         <br><br><br>
        <div class="page-header">
          <h4 style="text-align:center;"> Si aún no te has <a href="signUp.php">registrado</a>, no dudes en hacerlo. </h4> 
        </div>
        <br>
    </div>
		<?php  /* por si ocurre algun error al loguearse */
    if(isset($_SESSION['mal'])){
        hacerAlert($_SESSION['mal']);
        unset($_SESSION['mal']); 
    }?>
     
		<form class="col-md-2 col-md-offset-5" action="procesarLogIn.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on" name="logIn_form" onsubmit="return validateFormLogIn()">
      <input class="form-control" type="email" name="email" placeholder=" E-mail...">
      <br><br>
			<input class="form-control" type="password" name="pass" placeholder=" Contraseña...">
			<br><br><br>
      <input type="submit" name="submit" value="Log in" class=" center-block btn btn-warning">
	 </form>
  </div> <!-- Cierro row -->
 
 <!-------------------------------------------- Script para validar el login -->
  <script rel="text/javascript" src="js/logIn.js"></script>
 
  <?php 
  Include("footer.html"); ?>
 </body>
</html>
