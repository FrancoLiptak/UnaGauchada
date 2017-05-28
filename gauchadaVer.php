<?php
Include("header.php");
include_once 'validate.php';
include_once 'gauchadasFx.php';
?>
 <div class="row center-block">
    <div class="container-fluid  col-md-6 col-md-offset-3">
        <?php 
        $idGauchada = $_GET['idGauchadas'];

		if (validate($idGauchada)  ) {
		    showOneGauchada(getOneGauchada($idGauchada));
		}
		else {
		    $_SESSION['msg'] = "No selecciono ninguna gauchada.";
		    header('Location: index.php');
		    die;
		}
		?>
	</div>
</div>
  <?php Include("footer.html");?>