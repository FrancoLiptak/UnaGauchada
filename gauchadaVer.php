<?php
	session_start();
include_once "header.php";
include_once 'validate.php';
include_once 'gauchadasFx.php';
include_once 'fxComments.php';
?>
 <div class="row center-block">
    <div class="container-fluid  col-md-6 col-md-offset-3 box-detail">
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


<br><br><br>
<div class="container col-md-8 col-md-offset-2">
	<legend>Comentarios relacionados</legend>

	<?php 

	$comments = getCommentsForGauchada($idGauchada);
	if ($comments->num_rows > 0) {
		while ($row = $comments->fetch_assoc()){
			showComment($row);
		}
	}

	?>

<?php	
/*
	<p><span class='badge'>2</span> Comentarios:</p><br>

	<div class='row'>
	        <div class='col-sm-2 text-center'>
	       		 <img src='uploads/nophoto.png' class='img-circle' height='65' width='65' alt='Avatar'>
	        </div>
	        <div class='col-sm-10'>
		        <h4>Franco Liptak <small>Sep 29, 2015, 9:12 PM</small></h4>
		        <p>Genial! Muy interesante.</p>
		        <br>
	        </div>
	        <div class='col-sm-2 text-center'>
	        	<img src='uploads/nophoto.png' class='img-circle' height='65' width='65' alt='Avatar'>
	        </div>
	        <div class='col-sm-10'>
		        <h4>Sebastián Raimondi <small>Sep 25, 2015, 8:25 PM</small></h4>
		        <p>Quiero ayudar.</p>
		        <br>
		        <p><span class='badge'>1</span> Respuesta:</p><br>
		        <div class='row'>
		            <div class='col-sm-2 text-center'>
		           		 <img src='uploads/yo.jpg' class='img-circle' height='65' width='65' alt='Avatar'>
		            </div>
		            <div class='col-xs-10'>
			            <h4>Camila Onofri <small>Sep 25, 2015, 8:28 PM</small></h4>
			            <p>Gracias!!</p>
			            <br>
		            </div>
		        </div>
	        </div>
	</div>
*/
?>

	<?php 
	    if(isset($_SESSION['idUsers'])){?>
	    <br><br>
	    <legend>Deja un comentario!</legend>
	        <form role='form' class="comment">
			    <div class='form-group  col-md-offset-1'>
			    <textarea class='form-control comment' rows='3' placeholder="Ingresa tu comentario aquí" required></textarea>
			    </div>
			    <br>
			    &nbsp;<button type='submit' id="comment" class='btn btn-default'>Comentar &raquo;</button>
			</form>
	    <?php 
	   }
 ?>

</div>

  <?php Include("footer.html");?>