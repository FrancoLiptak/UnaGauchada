<?php function hacerAlert($msj, $type = "danger") {
		// Realiza un alert del tipo que se parametrice, y con el msj que se mande.
	?>
	<br><br><br><br><br>
  	<div class="alert alert-<?php echo $type; ?> alert-dismissable">
    	<button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong> Nota: </strong>
        <span> <?php echo $msj; ?> </span>
  	</div>
    <?php 
	}
 ?>