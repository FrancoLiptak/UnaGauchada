<li class="dropdown">
	  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mi cuenta<span class="caret"></span></a>
	  <ul class="dropdown-menu fondoGaucho gray">
		<?php if(isset($_SESSION['email'])){ ?> 
					<li><a target="_self" href="categorias.php">Categorias</a></li>
					<li><a target="_self" href="misGauchadas.php">Mis gauchadas</a></li>
					<li><a target="_self" href="publicar.php">Publicar gauchada</a></li>
					<li><a target="_self" href="editarPerfil.php">Editar perfil</a></li>
					<li><a target="_self" href="logOut.php">Log out</a></li>
		<?php }
		else{ ?>
		<li><a target="_self" href="logIn.php">Log in</a></li>
		<li role="separator" class="divider"></li>
		<li><a target="_self" href="signUp.php">Sign up</a></li>
		<?php } ?>
	  </ul>
</li>