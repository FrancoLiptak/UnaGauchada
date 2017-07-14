<html>

<head>
  <title>Categorias</title>
  <?php
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
      <div class="columns">
        <ul class="price">
          <li class="header"><small>CATEGORIAS</small> 
            <button class="btn btn-warning btn-circle btn-md" id="btnCircle" style="float: right; padding-top:12px; margin-top: -8px; outline: none!important;" data-toggle="modal" data-target="#squarespaceModal">
              <i class="fa fa-plus"  id="plus"></i>
            </button>
          </li>
          <?php 
            $categorias = getCategories();
            while ($cate = $categorias->fetch_assoc()) { ?>
               <li> <?php echo $cate['name']; ?>
                  <span style="float: right;  ">
                    <a href="editarCategoria.php?id=<?php echo $cate['idCategory']; ?>" role="button" class="btn btn-default btn-sm" >
                      <i class="fa fa-pencil-square-o"></i>
                    </a>
                    <a href="eliminarCategoria.php?id=<?php echo $cate['idCategory']; ?>" role="button" class="btn btn-default btn-sm" >
                      <i class="fa fa-trash "></i>
                    </a>
                  </span>
                </li> 
            <?php }
           ?>
          
        </ul>
      </div>
  </div> <!-- fin del div que contiene a la tabla de cates -->


<!-- line modal -->
<div class="modal fade" id="squarespaceModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
  <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <h3 class="modal-title" id="lineModalLabel">Añade una nueva categoría!</h3>
      </div>
      <div class="modal-body">
           <!-- content goes here -->
              <form class="" action="procesarCate.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on"
                name="formCate">
                <div class="form-group col-md-12">
                  <label><span class="glyphicon glyphicon-bookmark"></span> Nombre:</label>
                  <input class="form-control" type="text" name="cate" placeholder=" Categoria..." required>
                </div>
                <div class="form-group col-md-6">
                  <input type="submit" name="submit" id="submit" value="Crear" class=" btn btn-warning col-md-6">
                </div>
                <div class="form-group col-md-6">
                  <button type="button" id="submit" class="btn btn-danger" data-dismiss="modal"  role="button">Cancelar</button>
                </div>
              </form> <!-- fin del form -->
      </div>
      <div class="modal-footer" style="border:none;">
        
      </div>
  </div>
  </div>
</div>

  <!-- 

</div> <!-- fin del row -->

<?php include_once "footer.html"; ?>
</body>
</html>