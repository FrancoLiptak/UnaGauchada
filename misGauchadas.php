<html>
    <head>
        <?php
        include_once "header.php";
        include_once 'validate.php';
        include_once 'gauchadasFx.php';
        include_once 'alert.php';
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
                    if (!$row = $gauchadas->fetch_assoc()){
                        echo "<div class='alert alert-danger'>Aún no has publicado gauchadas</div>";
                        echo "<center><a type='button' class='btn btn-default btn-filter' href='publicar.php'>Publicar gauchada</a></center>";
                    }else{
                        while ($row = $gauchadas->fetch_assoc()) {
                        showGauchadaForAllPrueba($row);
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
