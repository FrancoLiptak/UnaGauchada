<?php
include_once "links.html";
include_once "connect.php";
include_once "doSelect.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION['idUsers'])) {
        $link= connect();
        $sql="select * from users where idUsers=".$_SESSION['idUsers'].";";
        $result= mysqli_query($link, $sql);
        $us = mysqli_fetch_array($result);
        $name=$us['name'];
        $surname=$us['surname'];
        $credits=$us['credits'];
        $photo=$us['photo'];
}
?>
  </head>

  <body>
    <header>
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
              aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
            <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home" aria-hidden=""></span> Inicio &nbsp;</a>
          </div>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
              <!-- nav der -->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-search"></span> Buscar <span class="caret"></span></a>
                <ul class="dropdown-menu gray">
                  <li>
                    <a href="#">
                      <form id="search" action="gauchadas.php?titulo=titulo&cat=cat&city=city" method="get">
                        <input class="search" type="text" name="titulo" placeholder=" Ingrese titulo">
                        <div style="margin-bottom: 15px" >
                        <select class="styled-select example" id="style-select" name="city">
                            <option value="0">Todas las ciudades</option>
                            <?php selectCity(); ?>
                        </select>&nbsp;
                        </div>
                        <select class="styled-select example" id="styled-select" name="cat">
                          <option value="0">Todas las categorias</option>
                          <?php selectCates(); ?>
                        </select>&nbsp;
                        <input type="submit" id="submit" name="ir" value="Ir" class="btn btn-warning">
                      </form>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- /cierro el search dropdown -->
              <li><a href="gauchadas.php"><span class="glyphicon glyphicon-globe"></span> Gauchadas </a></li>
              <?php if (!(isset($_SESSION['idUsers']))) {?>
              <li><a target="_self" href="logIn.php"><span class="glyphicon glyphicon-log-in"></span> Iniciar sesion </a></li>
              <li><a target="_self" href="signUp.php"><span class="glyphicon glyphicon-user"></span> Registrarme </a></li>
              <?php }?>
              <?php if (isset($_SESSION['idUsers'])) {
                  if (!($_SESSION['admin'])) { ?>
              <li><a target="_self" href="publicar.php"><span class="glyphicon glyphicon-plus"></span> Publicar </a></li>
              <?php } include_once "miCuenta.php"; 
                  if (!($_SESSION['admin'])) { ?>
              <li><a target="_self"><span class="glyphicon glyphicon-asterisk"></span> <?php echo $credits ?> créditos </a></li>
              <?php }
} ?>
            </ul>
            <!-- hasta aca nav derecha -->
          </div>
          <!-- /.navbar-collapse -->
        </div>
        <!-- /.container fluid-->
      </nav>
    </header>