<?php 
	function mostrarCat ($resultados, $id) {
		if ($id == $resultados['idCategory']) {
			$sel="selected";
		}else{
			$sel="";
		}
		?>
		<option name="cat" value="<?php echo $resultados['idCategory'] ?>" <?php echo $sel ?> > <?php echo $resultados['name'] ?> </option>
		<?php 
	}
?>