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

<style>

</style>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
      <div class="columns">
        <ul class="price">
          <li class="header">Categorias 
            <a href="" role="button" class="btn btn-warning btn-circle btn-md" style="float: right; padding-top:16px; margin-top: -8px;"><i class="fa fa-plus"></i></a>
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
  </div>
</div>

</body>
</html>