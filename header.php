<?php
	Include("links.html");
?>
</head>
<body>
  <header>
    <nav class="navbar navbar-inverse navbar-fixed-top fondoGaucho">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Home &nbsp;<span class="glyphicon glyphicon-home" aria-hidden=""></span></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
           <ul class="nav navbar-nav navbar-right"> <!-- nav der -->
                <li class="dropdown">
                 <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Buscar <span class="glyphicon glyphicon-search"></span> <span class="caret"></span></a>
                  <ul class="dropdown-menu fondoGaucho gray">
                        <li><a href="#">
                          <form id="shop"action="gauchadas.php?search=search&titulo=titulo&cat=cat" method="get">
                             <input class="titulo" type="text" name="titulo" placeholder=" Ingrese titulo"> <!-- se supone que tambien es por ciudad -->
                             <select class="styled-select" name="cat">
                                  <option>All categories</option>
                                  <?php /* hay que hacer el listado dinamico de categorias desde la BD */
                                  /*Include("connect.php");
                                  $link=connect();
                                  $categorias=mysqli_query($link, "SELECT * FROM categorias_productos");
                                  Include ("hacerOption.php");
                                  if(isset($_GET['cat']))
                                     $idC=$_GET['cat'];
                                  else 
                                    $idC=null;
                                     
                                  while ($filaCat = mysqli_fetch_array($categorias)){
                                  mostrarCat($filaCat, $idC);
                                  }
                                  mysqli_close($link);*/
                                  ?>
                            </select>&nbsp;
                        <input type="submit" name="search" value="Ir" class="btn btn-warning">
                      </form>
                    </a>
                 </li>
              </ul>
            </li> <!-- /cierro el search dropdown -->   
            <li><a href="gauchadas.php">Ver gauchadas <span class="glyphicon glyphicon-globe"></span></a></li>
            <?php Include("miCuenta.php"); ?>
          </ul> <!-- hasta aca nav derecha -->
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container fluid-->
    </nav>
  </header>