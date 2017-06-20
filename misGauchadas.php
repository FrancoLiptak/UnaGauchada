<html>
    <head>
        <?php
        include_once "header.php";
        include_once 'validate.php';
        include_once 'gauchadasFx.php';
        include_once 'alert.php';
        include("footer.html");
        ?>
        <br><br><br><br>
    </head>
    <body>
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
