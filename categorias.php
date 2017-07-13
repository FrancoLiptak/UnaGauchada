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
  <div class="col-md-6 col-md-offset-3" id="divCates"> 
      <div class="columns">
        <ul class="price">
          <li class="header"><small>CATEGORIAS</small> 
            <button class="btn btn-warning btn-circle btn-md" id="btnCircle" style="float: right; padding-top:12px; margin-top: -8px; outline: none!important;" onclick="return showFormCreateCate();">
              <i class="fa fa-plus" id="plus"></i>
              <i style="display:none;" id="cross" class="fa fa-times"></i>
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
 
  <div id="formCate" class="col-md-3" style="display:none; margin-top:15%;">
    <div class="columns">
      <form class="" action="procesarCate.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="on"
        name="formCate" onsubmit="return validateFormCate()">
        <div class="form-group">
          <label>Nombre de la nueva categoria:</label>
          <input class="form-control" type="text" name="cate" placeholder=" Categoria..." required>
        </div>
        <div class="form-group">
          <input type="submit" name="submit" id="submit" value="Crear" class="center-block btn btn-warning">
        </div>
      </form>
    </div>
  </div> <!-- fin del div que contiene al form -->

</div> <!-- fin del row -->

</body>
</html>
<script type="text/javascript">

function showFormCreateCate(){

      if (document.getElementById("formCate").style.display == 'none') {
          document.getElementById("divCates").className = " col-md-offset-2 col-md-6";
          document.getElementById("btnCircle").className = "btn btn-danger btn-circle btn-md";
          document.getElementById("cross").style.display = 'inline';
          document.getElementById("plus").style.display = 'none';
          document.getElementById("formCate").style.display = 'block';
      } else { 
          document.getElementById("divCates").className = " col-md-offset-3 col-md-6";
          document.getElementById("btnCircle").className = "btn btn-warning btn-circle btn-md";
           document.getElementById("cross").style.display = 'none';
          document.getElementById("plus").style.display = 'inline';
          document.getElementById("formCate").style.display = 'none';
      }
}

</script>