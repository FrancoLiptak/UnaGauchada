<html>

<head>
    <title>Gauchadas</title>
    <?php include_once "header.php";?>
    <?php
    include_once 'validate.php';
    include_once 'gauchadasFx.php';
    include_once 'alert.php';
    ?>

        <div class="row">
            <div class="container-fluid  col-md-4 col-md-offset-4">
                <div class="page-header">
                    <h3 style="text-align:center;">Gauchadas</h3>
                </div>
            </div>
        </div>
        <br>
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
        $condition = "1=1";

        if (isset($_GET['ir'])){
            $title=$_GET['titulo'];
            $cat=$_GET['cat'];
            $city=$_GET['city'];
            
            if (validate($title)) {
                $condition.=" AND title LIKE '%$title%'"; 
            }
            if (validate($title)) {
                $condition.= " AND idCategory=$cat";
            }
            if (validate($title)) {
                $condition.= " AND idCity=$city";
            }
        }

/*
            if ($cat==0){
                $condition.=" AND title LIKE '%$title%'"; //concatena
            }
            else {
                $condition.= " AND title LIKE '%$title%' AND idCategory=$cat";
            }
            if ($city==0){
                $condition.=" AND title LIKE '%$title%'"; //concatena
            }
            else {
                $condition.= " AND title LIKE '%$title%' AND idCity=$city";
            }
        }
*/

        $gauchadas = getGauchadas(10, $first, $condition);
        $i = $gauchadas->num_rows;
        switch ($i) {
            case 0:
                $_SESSION['msg'] = "No se encontraron resultados.";
                hacerAlert( $_SESSION['msg']);
                break;
            case 10:
                $siguiente = true;
                $i = 9;
                break;
        }
?>
    
        <div class="col-md-12">
            <div class="container">
                <div class="row">
                    <?php
                    while ($i > 0) {
                        showGauchadaForAllPrueba($gauchadas->fetch_assoc());
                        $i--;
                    }
?>
                </div>
            </div>
        </div>
           
            <br clear="all">
            <div class="container" style="width: 300px">

                <?php
                $prev = $first - 9;
                $next = $first + 9;
        ?>

                    <form action="gauchadas.php" method="post" style="float: left;">
                        <input type="submit" name='anterior' id='anterior' class="btn" value="&laquo; anterior" <?php if (!$anterior) { echo
                            "disabled"; } ?> >
                        <input type="numer" name="first" id="first" value=<?php echo $prev;?> hidden >
                    </form>
                    <form action="gauchadas.php" method="post" style="float: right;">
                        <input type="submit" name='proximo' id='proximo' class="btn " value="siguiente &raquo;" <?php if (!$siguiente) { echo
                            "disabled"; } ?> >
                        <input type="numer" name="first" id="first" value=<?php echo $next;?> hidden >
                    </form>

            </div>
            <!-- container -->
        </div>
    </div>
            <!-- pagination -->
            <?php include_once "footer.html" ;?>