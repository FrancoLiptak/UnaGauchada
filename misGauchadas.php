<html>
    <head>
        <?php
        include_once "header.php";
        include_once 'validate.php';
        include_once 'gauchadasFx.php';
        include_once 'alert.php';
        include("footer.html");
        ?>
    </head>
    <body>
        <div class="row">
            <div class="container-fluid  col-md-4 col-md-offset-4 ph">
                <div class="page-header">
                    <h3 style="text-align:center;">Mis gauchadas</h3>
                </div>
            </div>
        </div>
        <br>
        <?php
            $idUser = $_SESSION['idUsers'];
            $gauchadas = getGauchadas(10000, 0, $condition = "idUser='$idUser'");
        ?>
        <div class="col-md-12">
            <div class="container">
                <div class="row">
                    <?php
                        $iEntered= false;

                        while ($row = $gauchadas->fetch_assoc()) {
                            $iEntered= true;
                            showGauchadaForAllPrueba($row);
                        }

                        if(!$iEntered){
                                echo "<div class='alert alert-danger'>Aún no has publicado gauchadas</div>";
                                echo "<center><a type='button' class='btn btn-default btn-filter' href='publicar.php'>Publicar gauchada</a></center>";
                            }

                    
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
