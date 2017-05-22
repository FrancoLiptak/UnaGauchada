<html>
	<head>
	<title>Gauchadas</title>
  <?php Include("header.php");?>
  <div class="row center-block">
	  <br><br><br>
    <div class="container-fluid  col-md-4 col-md-offset-4">
        <div class="page-header">
          <h3 style="text-align:center;">Gauchadas</h3> 
        </div>
        <?php 
          Include("getGauchadas.php");
          Include("alert.php");
          if (!isset($_GET['pagina'])){ $pag=1;} /* para hacer paginacion */
          else { $pag = $_GET['pagina'];}
          $aux_pag=$pag;
          $first= (($aux_pag-1) * 10);
         /* $tildes = $link->query("SET NAMES 'utf8'"); //Para que se muestren las tildes correctamente */
          $date=date("Y-m-d");
          $condition= "caducidad >= '$date'";

          $totalTuplas= getGauchadas(10000, 0, $condition); //me traigo todas
          $cantTotalTuplas = mysqli_num_rows($totalTuplas);
         
          if (isset($_GET['search'])){
            $search=$_GET['search'];
            $title=$_GET['title'];
            $cat=$_GET['cat'];
            if ($cat=='All categories'){
                $condition.=" AND title LIKE '%$title%'"; //concatena
            }
            else {
                $condition.= " AND title LIKE '%$title%' AND idCategoria=$cat";
            }
          }
         
          $tuplasFiltradas = getGauchadas(10, $first, $condition);   
          $cantTotalPaginas = ceil($cantTotalTuplas / 10);

          if($cantTotalTuplas == 0){ //no hay gauchadas que cumplan la condicion provista
            $_SESSION['no_resultados']='mal';?> <!-- para que no haga el head de la tabla y tmp el numde pag-->
            <br>
            <br>
            <br>
            <?php if($title=="" ||  $title == null){ 
                  if($cat != 'All categories'){ 
                      $categorias = mysqli_query($link, "SELECT * FROM  categorias WHERE idCategoria=$cat");
                      $categoria = mysqli_fetch_array($categorias);
                      hacerAlert("La categoria".$categoria['nombre']." no posee gauchadas asociadas a ella.");
                 } 
            }else{ // title tiene un valor
                 hacerAlert("No se encontraron gauchadas acordes a ".$title);
            } 
            ?>
          <br>
          <br>
          <br>
          <a class="col-md-6 col-md-offset-3" href="<?php echo $_SERVER['HTTP_REFERER']; ?>"><i class="fa fa-chevron-left" aria-hidden="true"></i>  BACK</a>
          <br>
          <br>
          <br>
          <br>
        <?php } ?> <!-- end del if no se han encontrado resultados -->

       <div  <?php if(isset($_SESSION['email'])) { ?>class="row col-md-10 col-md-offset-1"<?php }else{?>class="row col-md-8 col-md-offset-2" <?php } ?>>
       <!-- hago lo de arriba porque si el usuario se logueo le muestro mas opciones en la tabla y ocupa mas lugar -->
        <?php if(!isset($_SESSION['no_resultados'])) { ?>
           <table class="table table-hover table-responsive">
            <thead>
             <tr>
                <th>Foto</th>
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Fecha de caducidad</th>
                <th>Ciudad</th>
                <?php if(isset($_SESSION['email'])){?>
                   <th>Opciones</th> 
                <?php } ?>     
             </tr>
            </thead>
            <?php } ?>
            <tbody>
              <?php Include("hacerTr.php");
              while ($gauchada = mysqli_fetch_array($tuplasFiltradas)){
                mostrarDatos($gauchada);
              }
              mysqli_free_result($gauchada);
              mysqli_close($link); ?> 
            </tbody>
           </table>
       </div> <!-- que contiene a las gauchadas -->
       <br clear="all">
       <div class="row">
         <ul class="pagination center-block ul_paginacion">
          <?php
           if (($pag - 1) > 0){ ?>
              <li>
                <a href="gauchadas.php?pagina=<?php echo $pag-1; if(isset($_GET['search'])){ ?>&title=<?php echo $_GET['title'];?>&search=<?php echo $_GET['search']; ?>&cat=<?php echo $_GET['cat']; }?>" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
                </a>
              </li>
          <?php } 
          
          if(!isset($_SESSION['no_resultados'])) { ?>
             <li><a href="#" a><?php echo $pag?></a></li>
          <?php }  
          unset($_SESSION['no_resultados']); 
          
          if(($pag + 1) <= $cantTotalPaginas){ ?>
              <li>
                <a href="shop.php?pagina=<?php echo $pag+1; if(isset($_GET['search'])){ ?>&title=<?php echo $_GET['title'];?>&search=<?php echo $_GET['search']; ?>&cat=<?php echo $_GET['cat']; }?>" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                </a>
              </li>
          <?php } ?>
        </ul>
      </div>  <!-- del row de paginacion -->

  </div> <!-- del row gigante -->
  <?php Include("footer.html");?>
