<?php 
	include_once 'connect.php';
	function mostrarDatos ($gauchada) {
		$link=connect(); 
		if ($gauchada !=NULL) {
		    ?>
		      <tr>  
				<td><img class="img-thumbnail img_table"src="mostrarImagen.php?idGauchada=<?php echo $gauchada['idGauchada']?>"></td>
		        <td><a href="detalle.php?idGauchada=<?php echo $gauchada['idGauchada']?>"> <?php echo $gauchada['title'] ?></a></td>
		        <td><?php
				$cat=$gauchada['idCategory'];
				$result =mysqli_query($link, "SELECT * FROM categorias WHERE idCategory=$cat");
				$fila =mysqli_fetch_array($result);
				echo $fila['nombre']  ?></td>  
		        <td><?php echo $gauchada['endDate'] ?></td>
		        <td><?php
				$city=$gauchada['idCity'];
				$result =mysqli_query($link, "SELECT * FROM ciudades WHERE idCity=$city");
				$fila =mysqli_fetch_array($result);
				echo $fila['nombre']  ?></td>  
		        
		        <?php
		         if(isset($_SESSION['email'])) {    
	 		        	$email=$_SESSION['email'];
						$idUs= mysqli_query($link, "SELECT * FROM usuarios WHERE email='$email'");
						$US = mysqli_fetch_array($idUs);
						$uss=  $US['idUsuario'];
							if ($gauchada['idUsuario']== $uss ){
							?>
			 		        	<td><a class="link" href="editar.php?idP=<?php echo  $gauchada['idGauchada'] ?>"><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:#00A388;"></i>  EDIT</a>
					        		<br><br>
					        		<a onclick="return myFunction()" class="link" href="eliminar.php?id=<?php echo  $resultados['idGauchada'] ?>&tabla=gauchadas"><i class="fa fa-trash" aria-hidden="true" style="color:#8A0917;"></i>  DELETE</a>
							        <br>
							    </td>
						    <?php }
			    }?>
		      </tr>
		<?php 
	    }
	}
 ?>




	 
