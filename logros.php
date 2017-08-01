<html>

<head>
	<title>Logros</title>
	<?php
	/* 
	sebas: para hacer codigo php para borrar un logro anda al form .form-eliminar para ver como se manda el idLogros en un input hidden a eliminarlogro.php. 
		Para el editar anda al form .form-editar para ver como se manda el idLogros en un input hidden junto con los otros datos a editarLogro.php. 
	Otra cosa, LOS CAMPOS DEL FORMULARIO SE PASAN POR GET. Lo hice para checkear que se mandaban.

	READ ME!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	Voy a explicar el funcionamiento del borrar/editar logros.
	Primero, estamos usando pop ups (mas precisamente divs de la clase modal) y se complico un poco el pasaje de parametros a estos. Lo que hago es que, al 
		hacer click en el boton que abre el modal para editar/borrar la logro particular, disparar una funcion js (que esta en este archivo abajo de todo) 
		que lo que hace es asignar el data-id del boton presionado (que va a ser la concatenacion: id/nombre del logro al que esta asociado el boton en 
		el caso de eliminar, y id/nombre/min para editar) al elemento html dentro del body del modal que tenga el id que yo le digo en la funcion (ver abajo).
	NOTAS:
		-Es importante notar los botones para elimnar y editar deben tener el att data-id="<datos del logro>".
		-Como en la funcion js lo que hago es cambiar el value de un elemento dentro del modal-body, ese elemento debe ser un input, li, option entre otros; 
			es decir, algun elemento html que tenga el att value. De todos los elementos que tienen value me sirve el input, es por eso que el nombre del logro 
			en el modal para eliminar se ve en un input text disabled, y necesito crear un form para que se envie el id del logro en un input hidden idLogros 
			al apretar 'Si, deseo eliminar'. ESTO ES IMPORTANTE PORQUE RECIEN ACA ES CUANDO SE MANDA A BORRAR!!!!! Se procesaria ese form en un eliminarLogro.php.
	*/
	include_once "validate.php";
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if (!(validateLogin())) {
		$_SESSION['msg'] = "No puede ingresar a Logros.php si no tiene una sesion iniciada.";
		header('Location: index.php');
		die;
	}
	if (!isAdmin()) {
		$_SESSION['msg'] = "No puede ingresar a Logros.php si no es administrador.";
		header('Location: index.php');
		die;
	}
	include_once "header.php";
	include_once "doSelect.php";
	include_once "gauchadasFx.php";
	include_once "fxLogros.php";
	?>
</head>
<body>

<div class="row">
	<div class="col-md-6 col-md-offset-3" id="divlogros"> 

		<?php
		if (isset($_SESSION['msg']) && $_SESSION['msg'] != "" ) {
			echo "<br><br><br><br>";
			hacerAlert($_SESSION['msg']);
			$_SESSION['msg'] = "";
		}
		if (isset($_SESSION['success'])) {
			echo "<br><br><br><br>";
			hacerAlert($_SESSION['success'], "success");
			unset($_SESSION['success']);
		}
		?>

		<div class="columns">
			<ul class="price">
				<li class="header"><small>LOGROS</small> 
					<button class="btn btn-warning btn-circle btn-md" id="btnCircle" style="float: right; padding-top:12px; margin-top: -8px; outline: none!important;" data-toggle="modal" data-target="#addModal">
						<i class="fa fa-plus"  id="plus"></i>
					</button>
				</li>
				<li class="grey">
					<span class="col-md-4"><small>NOMBRE</small></span>
					<span class="col-md-4"><small>MINIMO DE PUNTOS</small></span>
					<span class="col-md-4"><small>OPCIONES</small></span>
				</li>

				<?php 
				$Logros = getLogros();
				while ($logro = $Logros->fetch_assoc()) { 
				?>

					<li>
						<span class="col-md-4"><?php echo $logro['name']; ?></span>
						<span class="col-md-4"><?php echo $logro['min']; ?></span>
						<span class="col-md-4" style="float: right;  ">
							<a data-toggle="modal" data-target="#editModal" role="button" class="btn btn-default btn-sm openEditModal" data-id="<?php echo $logro['idLogros'].'/'.$logro['name'].'/'.$logro['min']; ?>" id="editButton" href="#!">
								<i class="fa fa-pencil-square-o"></i>
							</a>
							<a data-toggle="modal" data-target="#deleteModal" role="button" class="btn btn-default btn-sm openDeleteModal" data-id="<?php echo $logro['idLogros'].'/'.$logro['name']; ?>" id="deleteButton" href="#!">
								<i class="fa fa-trash "></i>
							</a>
						</span>
						<br>
					</li>
				
				<?php 
				}
				?>
				
			</ul>
		</div>
	</div> <!-- fin del div que contiene a la tabla de logros -->


	<!-- add cat modal -->
	<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h3 class="modal-title" id="lineModalLabel">Añade un nuevo logro!</h3>
			</div>
			<div class="modal-body">
				<!-- content goes here -->
				<form class="" action="agregarLogro.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on" name="formlogro">
					<div class="form-group col-md-6">
						<label><span class="glyphicon glyphicon-bookmark"></span> Nombre:</label>
						<input class="form-control" type="text" name="logro" placeholder=" Logro..." required>
					</div>
					<div class="form-group col-md-6">
						<label><span class="glyphicon glyphicon-bookmark"></span> Minimo de puntos:</label>
						<input class="form-control" type="number" name="min" placeholder=" Minimo ..." required>
					</div>
					<div class="form-group col-md-6">
						<button type="submit" id="submit" class=" btn btn-warning col-md-6">Crear</button>
					</div>
					<div class="form-group col-md-6">
						<button type="button" id="submit" class="btn btn-danger" data-dismiss="modal"  role="button">Cancelar</button>
					</div>
				</form> 
				<!-- fin del form -->
			</div>
			<div class="modal-footer" style="border:none;">
			</div>
		</div>
		</div>
	</div>

	<!-- delete modal -->
	<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h3 class="modal-title" id="lineModalLabel">¡Atencion!</h3>
			</div>
			<div class="modal-body">
				<!-- content goes here -->
				<p>Estas seguro que deseas eliminar el logro 
					<input type="text" class="form-control" style="display:inline; width: 29%;" id="nameLogro" disabled>?
				</p>
			</div>
			<div class="modal-footer" style="border:none;">
				<div class="col-md-6">
					<button  id="submit" style="float: left;" type="reset" class="btn btn-danger" data-dismiss="modal">Cancelar eliminacion</button>
				</div>
				<form class="form-inline form-eliminar col-md-6" action="eliminarLogro.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on" name="deletelogroForm">
					<input type="number" id="idLogros" name="idLogros" hidden>
					<button type="submit" id="submit" class="btn btn-primary">Si, deseo eliminar</button>
				</form>
			</div>
		</div>
		</div>
	</div>


	<!-- edit cat modal -->
	<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
				<h3 class="modal-title" id="lineModalLabel">Editar logro</h3>
			</div>
			<div class="modal-body">
				<!-- content goes here -->
				<form class="form-edit" action="editarLogro.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on" name="formEdit">
					<div class="form-group col-md-6">
						<label><span class="glyphicon glyphicon-bookmark"></span> Nombre:</label>
						<input class="form-control" id="nameLogro" type="text" name="logro" placeholder=" Logro..." required>
					</div>
					<div class="form-group col-md-6">
						<label><span class="glyphicon glyphicon-bookmark"></span> Minimo de puntos:</label>
						<input class="form-control" id="min" type="number" name="min" placeholder=" Minimo ..." required>
					</div>
					<div class="form-group col-md-6">
						<input type="number" id="idLogros" name="idLogros" hidden>
						<button type="submit" id="submit" class=" btn btn-warning col-md-6">Editar</button>
					</div>
					<div class="form-group col-md-6">
						<button type="button" id="submit" class="btn btn-danger" data-dismiss="modal"  role="button">Cancelar edición</button>
					</div>
				</form> 
				<!-- fin del form -->
			</div>
			<div class="modal-footer" style="border:none;">
			</div>
		</div>
		</div>
	</div>
</div> <!-- fin del row -->

<script type="text/javascript">
/* data('id') me trae el valor del att data-id del boton clickeado, que es: id/name del logro en cuestion para el delete modal, e id/name/min del logro en cuestion para el edit modal.
	 Con la funcion split lo que hago es crear un arreglo que separa sus elementos por el delimitador "/". Al abrir el modal le asigna el valor de ese arreglo creado en la pos 0 (corresponde al id de la logro) a cualquier elemento html dentro del modal-body con id="idLogros" y el valor de ese arreglo creado en la pos 1 (corresponde al nombre de la logro) a cualquier elemento html dentro del modal-body con id="nameLogro".
	 En el edit modal se asigna la pos 2 del arreglo a cualquier elemento con el id 'min'; corresponde al minimo de puntos para adquirir ese logro.
*/

$(document).on("click", ".openDeleteModal", function () {
	var idAndName = $(this).data('id').split("/", 2);
	$(".modal-body #nameLogro").val( idAndName[1] );
	$(".form-eliminar #idLogros").val( idAndName[0] );
});

/* Para edditar logros ..*/
$(document).on("click", ".openEditModal", function () {
	var idAndName = $(this).data('id').split("/", 3);
	$(".form-edit #min").val( idAndName[2] );
	$(".form-edit #nameLogro").val( idAndName[1] );
	$(".form-edit #idLogros").val( idAndName[0] );
});
</script>

<?php 
include_once "footer.html"; 
?>

</body>
</html>