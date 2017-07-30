<?php 
include_once 'validate.php';
include_once 'fxCompras.php';
include_once "alert.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!(validateLogin())) {
    $_SESSION['msg'] = "No puede ingresar a usersRanking.php si no tiene una sesion iniciada.";
    header('Location: index.php');
    die;
}
if (!isAdmin()) {
    $_SESSION['msg'] = "No puede ingresar a usersRanking.php si no es administrador.";
    header('Location: index.php');
    die;
}
if (isset($_SESSION['mal_completado'])) {
            hacerAlert($_SESSION['mal_completado']);
            unset($_SESSION['mal_completado']);
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
                <p class="navbar-text">En esta sección usted podrá ver todas las compras registradas en unaGauchada. Por defecto, se muestran las del último mes.</p>
            </div>
        </nav>
    </div>

    <!-- FECHAS -->

        <div class="col-md-12">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <!-- FECHAS -->

                        <form action="procesarFiltroFechasGanancias.php" method="post">
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
                                <button type="submit" class="btn btn-default">Filtrar</button>
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
                    $ventas = getVentas();
                    foreach ($ventas as $element){
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
                ?>
            </tbody>
    </table>
</div>
</body>
<?php include_once "footer.html" ;?>
<script src="js/jquery-1.0.4.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-1.12.4.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
</html>

