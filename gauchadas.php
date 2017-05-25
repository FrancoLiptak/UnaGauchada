<html>
	<head>
	<title>Gauchadas</title>
  <?php include_once "header.php";?>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <?php 
  include_once 'validate.php';
  include_once 'gauchadasFx.php';
  $anterior = false;
  $siguiente = false;

  if(isset($_POST['first'])){
    $first = $_POST['first'];
  }
  else {
    $first = 0;
  }

  if (!$first == 0) {
    $anterior = true;
  }

  $hoy = date("Y-m-d");
  $condition = "";
  $gauchadas = getGauchadas(10, $first);
  $i = $gauchadas->num_rows;
  echo $i;
  switch ($i) {
    case 0:
      $_SESSION['msg'] = "No se encontraron resultados.";
      break;
    case 10:
      $siguiente = true;
      $i = 9;
      break;
  }
  while ($i > 0) {
    showGauchadaForAll($gauchadas->fetch_assoc()); ?>
  <br>
  <br>
  <br>
  <?php
    $i--;
  }  
$prev = $first - 9;
$next = $first + 9;
  ?>  

<form action="gauchadas.php" method="post">
    <input type="submit" name='anterior' id='anterior' value="anterior" <?php if (!$anterior) {echo "disabled";} ?> />
    <input type="numer" name="first" id="first" value=<?php echo $prev;?> hidden />
</form>
<form action="gauchadas.php" method="post">
    <input type="submit" name='proximo' id='proximo' value="proximo"  <?php if (!$siguiente) {echo "disabled";} ?> />
    <input type="numer" name="first" id="first" value=<?php echo $next;?> hidden />
</form>


  <?php Include("footer.html");?>
