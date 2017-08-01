<?php 
include_once 'validate.php';
include_once 'fxCompras.php';
include_once "alert.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!(validateLogin())) {
    $_SESSION['msg'] = "No puede ingresar a ganancias.php si no tiene una sesion iniciada.";
    header('Location: index.php');
    die;
}
if (!isAdmin()) {
    $_SESSION['msg'] = "No puede ingresar a ganancias.php si no es administrador.";
    header('Location: index.php');
    die;
}
if (isset($_SESSION['fechaInvalida'])) {
        hacerAlert($_SESSION['fechaInvalida']);
        unset($_SESSION['fechaInvalida']);
        }
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge"> 
    <link rel="stylesheet" type="text/css" href="css/jquery.dataTables.min.css">  
    <?php include_once "header.php";?>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/verGanancias.js"></script>
      
    <title>Ganancias</title>
    <br><br><br><br><br>
</head>
<div class="container">
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <span class="navbar-brand">Ganancias</span>
                </div>
                <p class="navbar-text">En esta sección usted podrá ver todas las compras registradas en unaGauchada.<strong> Por defecto, se muestran las del último mes.</strong></p>
            </div>
        </nav>
    </div>

    <!-- FECHAS -->

        <div class="col-md-12">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <!-- FECHAS -->

                      <form name="fechas" action="ganancias.php?fechaMinima=fechaMinima&fechaMaxima=fechaMaxima" method="get" onsubmit="return validarFechas()">
                            <div class='col-md-1'></div>
                            <div class='col-md-4'>
                                <div class="form-group">
                                    <p>Seleccione una fecha mínima</p>
                                    <div class='input-group date'>
                                        <input type='date' class="form-control" name="fechaMinima" id="fechaMinima"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-4'>
                                <div class="form-group">
                                    <p>Seleccione una fecha máxima</p>
                                    <div class='input-group date'>
                                        <input type='date' class="form-control" name="fechaMaxima" id="fechaMaxima"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-2'>
                                <br>
                                <p></p>
                                <input type="submit" id="submit" name="filtrar" value="Filtrar" class="btn btn-default">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    <!-- FECHAS -->



    <table id="example" class="display" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th><center>Fecha y hora</center></th>
                    <th><center>Nombre</center></th>
                    <th><center>Apellido</center></th>
                    <th><center>Cantidad de créditos</center></th>
                    <th><center>Valor total</center></th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th><center>Fecha y hora</center></th>
                    <th><center>Nombre</center></th>
                    <th><center>Apellido</center></th>
                    <th><center>Cantidad de créditos</center></th>
                    <th><center>Valor total</center></th>
                </tr>
            </tfoot>
            <tbody>
                <?php

                    if (isset($_GET['filtrar'])){
                        $fechaMinima=$_GET['fechaMinima'];
                        $fechaMaxima=$_GET['fechaMaxima'];
                    }else{
                        $fechaMinima = null;
                        $fechaMaxima = null;
                    }

                    $cantidadTotalCreditos = 0;
                    $dineroTotalRecaudado = 0;

                    if($ventas = getVentas($fechaMaxima, $fechaMinima)){
                        foreach ($ventas as $element){
                            $cantidadTotalCreditos += $element['cantidad'];
                            $dineroTotalRecaudado += $element['monto'];

                        ?>

                        <tr>
                            <td><center><?php echo $element['fechaHora']; ?></center></td>
                            <td><center><?php echo $element['nombre']; ?></center></td>
                            <td><center><?php echo $element['apellido']; ?></center></td>
                            <td><center><?php echo $element['cantidad']; ?></center></td>
                            <td><center><?php echo $element['monto']; ?></center></td>
                        </tr>

                        <?php
                        }
                    }else{
                        ?>
                        <tr>
                            <td colspan="5"><center><?php echo "No se encontraron resultados"; ?></center></td>
                        </tr>
                        <?php
                    }
                    
                ?>
            </tbody>
    </table>
    <br>
    <div class="row">
        <nav class="navbar navbar-default barraGanancias">
            <div class="container">
                <div class="navbar-header centrado">
                    <?php 
                        if($cantidadTotalCreditos == 0){
                            $text = "No se han registrado ventas hasta el momento.";
                        }else{
                            $text ="Créditos vendidos: $cantidadTotalCreditos. Recaudación total: ARS $dineroTotalRecaudado.";
                        }
                    ?>
                    <span class="navbar-brand textGanancias"><?php echo $text; ?></span>
                </div>
            </div>
        </nav>
    </div>

</div>
</body>
<?php include_once "footer.html" ;?>
<script src="js/jquery-1.0.4.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/alertGanancias.js"></script>
</html>

