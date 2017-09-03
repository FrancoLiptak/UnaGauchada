<html>

<head>

	<title>Editar perfil</title>

	<?php 
	include_once "validate.php";
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if (!validateLogin()) {
		$_SESSION['msg'] = "No puede ingresar a editarPerfil.php si no tiene una sesion iniciada.";
		header('Location: index.php');
		die;
	}
	include_once 'usersFx.php';
	include_once "header.php";
	include_once "alert.php";
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	include_once "validate.php";
	$user = mysqli_fetch_array(getUser($_SESSION['idUsers']));
	?>

	<script>
		var realPass = "<?php echo $user['pass']; ?>";
	</script>

	<div class="row">
		<div class="container-fluid col-md-6 col-md-offset-3 ph">
			<div class="page-header">
				<h4 style="text-align:center;">Editar Perfil</h4>
			</div>
		</div>
		<?php
		/* a continuacion van todas las validaciones en php ... */
		if (isset($_SESSION['msg']) && $_SESSION['msg'] != "" ) {
			hacerAlert($_SESSION['msg']);
			$_SESSION['msg'] = "";
		}
		if (isset($_SESSION['success'])) {
			hacerAlert($_SESSION['success'], "success");
			unset($_SESSION['success']);
		}
		?>
		<form enctype="multipart/form-data" id="signUp_form" class="col-md-4 col-md-offset-4" action="procesarEditarPerfil.php" method="post"
			target="_self" accept-charset="UTF-8" autocomplete="on" name="signUp_form" onsubmit="return validateFormEditarPerfil()">
			<div class="row">
				<div class="form-group col-md-6">
					<label>Foto de perfil:</label>
					<div class="input-group">
						<span class="input-group-btn">
						<span class="btn btn-default btn-file">
							Actualizar <input type="file" id="imgInp" name="imgInp">
						</span>
						</span>
						<input type="text" class="form-control" readonly>
					</div>
					<img id='img-upload' src=<?php if ($user['photo']==null) echo "uploads/nophoto.png"; else echo $user['photo']; ?> />
				</div>
				<div class="form-group col-md-6">
					<label><span class="glyphicon glyphicon-bookmark"></span> Nombre:</label>
					<input class="form-control" type="text" name="name" placeholder=" Nombre" value="<?php echo $user['name'];?>" required>
				</div>
				<div class="form-group col-md-6">
					<label><span class="glyphicon glyphicon-bookmark"></span> Apellido:</label>
					<input class="form-control" type="text" name="surname" placeholder=" Apellido" value="<?php echo $user['surname'];?>" required>
				</div>
				<div class="form-group col-md-6">
					<label><span class="glyphicon glyphicon-bookmark"></span> Email:</label>
					<input class="form-control" type="email" name="email" placeholder=" E-mail" value="<?php echo $user['email'];?>" required>
				</div>
			</div>
			<!-- fin row -->
			<div class="row ">
				<div class="form-group col-md-6">
					<label><span class="glyphicon glyphicon-bookmark"></span> Teléfono: <span class="form-note">(Sólo numeros)</span></label>
					<input class="form-control" type="tel" name="phone" placeholder=" Teléfono" value="<?php echo $user['phone'];?>" required>
				</div>
				<div class="form-group col-md-6">
					<label><span class="glyphicon glyphicon-bookmark"></span> Fecha de Nacimiento:</label>
					<?php  
						$fecha = date('Y-m-d');
						$nuevafecha = strtotime ( '-18 year' , strtotime ( $fecha ) ) ;
						$nuevafecha = date ( 'Y-m-j' , $nuevafecha );
						?>
					<input class="form-control" type="date" value="<?php echo $user['birthDate'];?>" name="birthDate" max="<?php echo $nuevafecha;?>"
						required>
				</div>
			</div>
			<!-- fin row -->

			<div class="panel panel-default">
				<div class="panel-body">
					<div class="form-group" id="updatePassDiv">
						<div class="col-md-6">
							<label><span class="glyphicon glyphicon-bookmark"></span> Contraseña: </label>
							<input class="form-control" type="password" value="12345678910" disabled>
						</div>
						<a style="margin-top:25px;" class="btn btn-md btn-primary col-md-6" onclick="showConfirmPassDiv();"><i class="fa fa-lock"></i> Actualizar contraseña</a>
					</div>
					<!-- fin old pass update -->

					<div style="display:none;" class="form-group" id="oldPassConfirmDiv">
						<div id="infoRealPassDiv">
							<?php hacerAlertV2("Ingresa la contraseña actual para verificar que eres tu.","info","info-sign"); ?>
						</div>
						<!-- fin wrong validation -->
						<div id="wrongValidationDiv" style="display:none;">
							<?php hacerAlertV2("Contraseña invalida. Vuelve a intentar."); ?>
						</div>
						<!-- fin wrong validation -->

						<div class="col-md-6">
							<label><span class="glyphicon glyphicon-bookmark"></span> Contraseña Actual:</label>
							<input id="insertedPass" class="form-control" type="password" placeholder=" Contraseña" onfocus="wrongValidationDiv.style.display = 'none'; infoRealPassDiv.style.display = 'block';">
						</div>
						<div class="col-md-6">
							<a style="margin-top:25px;" class="btn btn-md btn-primary col-md-12" onclick="validatePass()"><i class="fa fa-lock"></i> Validar contraseña</a>
						</div>
						<div class="form-group col-md-12" id="cancelarPassDiv">
							<br clear="all">
							<a name="cancelar-pass" class="btn btn-md btn-danger col-md-12" onclick="cancelPassUpdating(oldPassConfirmDiv)"><i class="fa fa-lock"></i> Cancelar cambio de contraseña</a>
						</div>
					</div>
					<!-- fin old pass confirm -->

					<div id="newPassDiv" style="display:none;">
						<?php hacerAlertV2("Ingresa y luego confirma la nueva contraseña.","info","info-sign"); ?>
						<div class="form-group col-md-6">
							<label><span class="glyphicon glyphicon-bookmark"></span> Nueva Contraseña: </label>
							<input class="form-control" type="password" name="pass1" id="pass1" placeholder=" Contraseña">
						</div>
						<div class="form-group col-md-6">
							<label><span class="glyphicon glyphicon-bookmark"></span> Confirmar:</label>
							<input class="form-control" type="password" name="pass2" id="pass2" placeholder=" Comfirmar">
						</div>
						<div class="form-group col-md-12">
							<a name="cancelar-pass" class="btn btn-md btn-danger col-md-12" onclick="cancelPassUpdating(newPassDiv)"><i class="fa fa-lock"></i> Cancelar cambio de contraseña</a>
						</div>
					</div>
					<!-- fin new pass -->

				</div>
				<!-- fin panel body -->
			</div>
			<!-- fin panel deffault -->

			<input type="submit" name="submit" id="submit" class="btn btn-warning center-block" value="Guardar Cambios">
		</form>
	</div>

	<!----------------------------------- Script para validar el Editar -->
	<script rel="text/javascript" src="js/imagePreviewer.js"></script>
	<script rel="text/javascript" src="js/editarPerfil.js"></script>
	<script rel="text/javascript" src="js/signUp.js"></script>

	<?php Include("footer.html"); ?>
	</body>

</html>