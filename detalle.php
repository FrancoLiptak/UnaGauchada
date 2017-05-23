<html>
	<head>
	<title>Detalle</title>
  <?php Include("header.php");
  Include("getGauchadas.php");
  $gauchada=getOneGauchada(1);
  ?>
  <div class="row center-block">
	  <br><br><br>
    <div class="container-fluid  col-md-4 col-md-offset-4">
        <div class="page-header">
          <h3 style="text-align:center;"><?php echo "es la gau:".$gauchada['title']; ?></h3> 
        </div>

  <?php Include("footer.html");?>