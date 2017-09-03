<html>

<head>
  <title>Detalle</title>
  <?php include_once "header.php";
  include_once "getGauchadas.php";
  $gauchada=getOneGauchada(1);
    ?>
  <div class="row center-block">
    <div class="container-fluid  col-md-4 col-md-offset-4">
      <div class="page-header">
        <h3 style="text-align:center;">
            <?php echo "es la gau:".$gauchada['title']; ?>
        </h3>
      </div>

        <?php include_once  "footer.html";?>
