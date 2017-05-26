<html>
	<head>
	<title>Gauchadas</title>
  <?php include_once "header.php";?>
    <?php
    include_once 'validate.php';
    include_once 'gauchadasFx.php';?>

    <div class="row">
        <div class="container-fluid  col-md-4 col-md-offset-4">
            <div class="page-header">
                <h3 style="text-align:center;">Gauchadas</h3> 
            </div>
        </div>
    </div>

    <?php 
    $anterior = false;
    $siguiente = false;

    if (isset($_POST['first'])) {
        $first = $_POST['first'];
    } else {
        $first = 0;
    }

    if (!$first == 0) {
        $anterior = true;
    }

    $hoy = date("Y-m-d");
    $condition = "";
    $gauchadas = getGauchadas(10, $first);
    $i = $gauchadas->num_rows;
    switch ($i) {
        case 0:
            $_SESSION['msg'] = "No se encontraron resultados.";
            break;
        case 10:
            $siguiente = true;
            $i = 9;
            break;
    }
    ?>

    <div  <?php if(isset($_SESSION['idUsers'])) { ?>class="row col-md-10 col-md-offset-1"<?php }else{?>class="row col-md-8 col-md-offset-2" <?php } ?>>
    <?php if(!isset($_SESSION['no_resultados'])) { ?>
     <table class="table table-hover table-responsive">
      <thead>
       <tr>
          <th>Imágen</th>
          <th>Titulo</th>
          <th>Publicante</th>
          <th>Categoría</th>
          <th>Ciudad</th>
          <th>Días restantes</th>
          <th>Opciones</th>    
       </tr>
     </thead>
    <?php } ?>
    <tbody>
      <?php
         while ($i > 0) {
             showGauchadaForAll($gauchadas->fetch_assoc()); 
             $i--;
         } ?>
       
   </tbody>
  </table>
 </div>
 <br clear="all">
 <div class="row">

       <?php 
        $prev = $first - 9;
        $next = $first + 9;
        ?>  
        <div class="container col-md-2 col-md-offset-5">     
                <form action="gauchadas.php" method="post" class"">
                    <input type="submit" name='anterior' id='anterior' class="btn btn-daffault pag" value="&laquo; anterior" <?php if (!$anterior){ echo "disabled"; } ?> >
                    <input type="numer" name="first" id="first" value=<?php echo $prev;?> hidden >
                </form>
                <form action="gauchadas.php" method="post" class"">
                    <input type="submit" name='proximo' id='proximo' class="btn btn-daffault pag" value="siguiente &raquo;"  <?php if (!$siguiente){ echo "disabled"; } ?> >
                    <input type="numer" name="first" id="first" value=<?php echo $next;?> hidden >
                </form>
       
        </div> <!-- container -->
</div> <!-- pagination -->
    <?php include("footer.html");?>
