<html>

<head>
	<title>Categorias</title>
	<?php
	/* 
	sebas: para hacer codigo php para borrar una cate anda al form .form-eliminar para ver como se manda el idCategory
		en un input hidden a eliminarCate.php. Para el editar anda al form .form-editar para ver como se manda el se manda
		el idCategory en un input hidden a editarCate.php. 
	Otra cosa, LOS CAMPOS DEL FORMULARIO SE PASAN POR GET. Lo hice para checkear que se mandaban.

	READ ME!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	Voy a explicar el funcionamiento del borrar/editar cates.
	Primero, estamos usando pop ups (mas precisamente divs de la clase modal) y se complico un poco el pasaje de parametros 
		a estos. Lo que hago es que, al hacer click en el boton que abre el modal para editar/borrar la cate particular, disparar 
		una funcion js (que esta en este archivo abajo de todo) que lo que hace es asignar el data-id del boton presionado (que 
		va a ser la concatenacion: id/nombre de la categoria a la que esta asociado el boton) al elemento html dentro del body 
		del modal que tenga el id que yo le digo en la funcion (ver abajo).

	NOTAS:
		- Es importante notar los botones para elimnar y editar deben tener el att data-id="<datos de la cate>".
		- Como en la funcion js lo que hago es cambiar el value de un elemento dentro del modal-body, ese elemento debe ser un input, 
			li, option entre otros; es decir, algun elemento html que tenga el att value. De todos los elementos que tienen value me sirve 
			el input, es por eso que el nombre de la categoria se ve en un input text disabled, y necesito crear un form para que se envie el 
			id de la categoria en un input hidden idCategory al apretar 'Si, acepto'. ESTO ES IMPORTANTE PORQUE RECIEN ACA ES CUANDO SE MANDA 
			A BORRAR!!!!! Se procesaria ese form en un eliminarCate.php.
	*/
	include_once "validate.php";
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	if (!(validateLogin())) {
		$_SESSION['msg'] = "No puede ingresar a Categorias.php si no tiene una sesion iniciada.";
		header('Location: index.php');
		die;
	}
	if (!isAdmin()) {
		$_SESSION['msg'] = "No puede ingresar a Categorias.php si no es administrador.";
		header('Location: index.php');
		die;
	}
	include_once "header.php";
	include_once "doSelect.php";
	include_once "gauchadasFx.php";
	include_once "fxCategory.php";
	?>
</head>

<body>
	<div class="row">
		<div class="col-md-6 col-md-offset-3" id="divCates">

			<?php
			if (isset($_SESSION['msg']) && $_SESSION['msg'] != "" ) {
				hacerAlert($_SESSION['msg']);
				$_SESSION['msg'] = "";
			}
			if (isset($_SESSION['success'])) {
				hacerAlert($_SESSION['success'], "success");
				unset($_SESSION['success']);
			}
			?>
			<br Clear="all">
			<div class="columns">
				<ul class="price">
					<li class="header"><small>CATEGORIAS</small>
						<button class="btn btn-warning btn-circle btn-md" id="btnCircle" style="float: right; padding-top:12px; margin-top: -8px; outline: none!important;"
						    data-toggle="modal" data-target="#addCatModal">
			            	<i class="fa fa-plus"  id="plus"></i>
			            </button>
					</li>

					<?php 
					$categorias = getCategories();
					while ($cate = $categorias->fetch_assoc()) { 
					?>

					<li><span <?php if ($cate['deleted'] == 1){ ?>style="color:red;" <?php } ?>>
							<?php echo $cate['name']; ?>
						</span>
						<span style="float: right;  ">
							<a data-toggle="modal" data-target="#editModal" role="button" class="btn btn-default btn-sm openEditModal" data-id="<?php echo $cate['idCategory'].'/'.$cate['name']; ?>" id="editButton" href="#!">
								<i class="fa fa-pencil-square-o"></i>
							</a>
							<a data-toggle="modal" data-target="#deleteModal" role="button" class="btn btn-default btn-sm openDeleteModal" data-id="<?php echo $cate['idCategory'].'/'.$cate['name']; ?>" id="deleteButton" href="#!">
								<i class="fa fa-trash "></i>
							</a>
						</span>
					</li>

					<?php 
					} 
					?>

				</ul>
			</div>
		</div>
		<!-- fin del div que contiene a la tabla de cates -->

		<!-- add cat modal -->
		<div class="modal fade" id="addCatModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
						<h3 class="modal-title" id="lineModalLabel">Añade una nueva categoría!</h3>
					</div>
					<div class="modal-body">
						<!-- content goes here -->
						<form class="" action="procesarCate.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on" name="formCate">
							<div class="form-group col-md-12">
								<label><span class="glyphicon glyphicon-bookmark"></span> Nombre:</label>
								<input class="form-control" type="text" name="cate" placeholder=" Categoria..." required>
							</div>
							<div class="form-group col-md-6">
								<button type="submit" id="submit" class=" btn btn-warning col-md-6">Crear</button>
							</div>
							<div class="form-group col-md-6">
								<button type="button" id="submit" class="btn btn-danger" data-dismiss="modal" role="button">Cancelar</button>
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
						<p>Estas seguro que deseas eliminar la categoria
							<input type="text" class="form-control" style="display:inline; width: 20%;" id="nameCategory" disabled>?
						</p>
					</div>
					<div class="modal-footer" style="border:none;">
						<div class="col-md-6">
							<button id="submit" style="float: left;" type="reset" class="btn btn-danger" data-dismiss="modal">Cancelar eliminacion</button>
						</div>
						<form class="form-inline form-eliminar col-md-6" action="eliminarCate.php" method="post" target="_self" accept-charset="UTF-8"
						    autocomplete="on" name="deleteCateForm">
							<input type="number" id="idCategory" name="idCategory" hidden>
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
						<h3 class="modal-title" id="lineModalLabel">Editar categoria</h3>
					</div>
					<div class="modal-body">
						<!-- content goes here -->
						<form class="form-edit" action="editarCate.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on" name="formEdit">
							<div class="form-group col-md-12">
								<label><span class="glyphicon glyphicon-bookmark"></span> Nombre:</label>
								<input class="form-control" type="text" name="cate" id="nameCategory" placeholder=" Categoria..." required>
								<input type="number" id="idCategory" name="idCategory" hidden>
							</div>
							<div class="form-group col-md-6">
								<button type="submit" id="submit" class=" btn btn-warning col-md-6">Editar</button>
							</div>
							<div class="form-group col-md-6">
								<button type="button" id="submit" class="btn btn-danger" data-dismiss="modal" role="button">Cancelar edición</button>
							</div>
						</form>
						<!-- fin del form -->
					</div>
					<div class="modal-footer" style="border:none;">
					</div>
				</div>
			</div>
		</div>



	</div>
	<!-- fin del row -->

	<script type="text/javascript">
		/* data('id') me trae el valor del att data-id del boton clickeado, que es: id/name de la categoria en cuestion. Con la funcion split lo que hago es crear un arreglo que separa sus elementos por el delimitador "/". Al abrir el modal le asigna el valor de ese arreglo creado en la pos 0 (corresponde al id de la categoria) a cualquier elemento html dentro del modal-body con id="idCategory" y el valor de ese arreglo creado en la pos 1 (corresponde al nombre de la categoria) a cualquier elemento html dentro del modal-body con id="nameCategory".
		 */

		$(document).on("click", ".openDeleteModal", function () {
			var idAndName = $(this).data('id').split("/", 2);
			$(".modal-body #nameCategory").val(idAndName[1]);
			$(".form-eliminar #idCategory").val(idAndName[0]);
		});

		/* Para edditar cates ..*/
		$(document).on("click", ".openEditModal", function () {
			var idAndName = $(this).data('id').split("/", 2);
			$(".modal-body #nameCategory").val(idAndName[1]);
			$(".form-edit #idCategory").val(idAndName[0]);
		});
	</script>

	<?php include_once "footer.html"; ?>
</body>

</html>