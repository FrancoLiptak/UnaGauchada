<?php
	include_once "links.html";
  include_once "connect.php";
  include_once "doSelect.php";
  session_start();
  if(isset($_SESSION['idUsers'])){
            $link= connect();
            $sql="select name from users where idUsers=".$_SESSION['idUsers'].";";
            $result= mysqli_query($link, $sql);
            $us = mysqli_fetch_array($result);
            $name=$us['name'];
  }
?>
</head>
<body>
  <header>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Inicio &nbsp;<span class="glyphicon glyphicon-home" aria-hidden=""></span></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
           <ul class="nav navbar-nav navbar-right"> <!-- nav der -->
                <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Buscar <span class="glyphicon glyphicon-search"></span> <span class="caret"></span></a>
                  <ul class="dropdown-menu gray">
                        <li><a href="#">
                          <form id="search"action="gauchadas.php?search=search&titulo=titulo&cat=cat" method="get">
                             <input class="search" type="text" name="titulo" placeholder=" Ingrese titulo"> <!-- se supone que tambien es por ciudad -->
                             <select class="styled-select" id="styled-select" name="cat">
                                <option value="0">Todas las categorias</option>
                                <?php selectCates(); ?>
                            </select>&nbsp;
                        <input type="submit" id="ir" name="ir" value="Ir" class="btn btn-warning">
                      </form>
                    </a>
                 </li>
              </ul>
            </li> <!-- /cierro el search dropdown -->   
            <li><a href="gauchadas.php">Ver gauchadas <span class="glyphicon glyphicon-globe"></span></a></li>
            <?php if(!(isset($_SESSION['idUsers']))){?>
              <li><a target="_self" href="logIn.php">Iniciar sesion <span class="glyphicon glyphicon-log-in"></span></a></li>
              <li><a target="_self" href="signUp.php">Registrarme <span class="glyphicon glyphicon-user"></span></a></a></li>
             <?php }?>
            <?php if(isset($_SESSION['idUsers'])){?><li><a target="_self" href="publicar.php">Publicar gauchada <span class="glyphicon glyphicon-plus-sign"></a></li><?php Include("miCuenta.php"); }?>
          </ul> <!-- hasta aca nav derecha -->
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container fluid-->
    </nav>
  </header>