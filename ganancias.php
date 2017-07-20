<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/ganancias.css">    
    <?php include_once "header.php";?>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

      
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
                <p class="navbar-text">En esta sección, usted podrá ver las ganancias entre dos fechas elegidas. Por defecto, se muestran las ganancias desde el comienzo de unaGauchada.</p>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <!-- FECHAS -->
                        <div class='col-md-2'>
                                <p class="centered">Resultados por página<p>
                                <div class="form-group">
                                    <input type='number' class="form-control" placeholder="Ingrese cantidad" />
                                </div>
                            </div>
                            <div class='col-md-5'>
                                <p class="centered">Fecha mínima<p>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker6'>
                                        <input type='text' class="form-control" placeholder="Seleccione una fecha mínima" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class='col-md-5'>
                                <p class="centered">Fecha máxima<p>
                                <div class="form-group">
                                    <div class='input-group date' id='datetimepicker7'>
                                        <input type='text' class="form-control" placeholder="Seleccione una fecha máxima"/>
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- FIN FECHAS -->
                <div class="panel-body">
                    <table id="mytable" class="table table-striped table-bordered table-list">
                        <thead>
                        <tr>
                            <th class="col-text centered">Nombre</th>
                            <th class="col-text centered">Email</th>
                            <th class="col-text centered">Cantidad de créditos</th>
                            <th class="col-text centered">Valor total</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td align="center">
                                    Franco Emanuel Liptak
                                </td>
                                <td align="center">
                                    francoliptak@gmail.com
                                </td>
                                <td align="center">
                                    2
                                </td>
                                <td align="center">
                                    $ 100
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
                <div class="panel-footer">
                    <div class="row">
                        <nav class="navbar navbar-default">
                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <div class="navbar-header">
                                    <span class="navbar-brand">GANANCIAS TOTALES</span>
                                </div>
                                <p class="navbar-text">El monto total recaudado entre las dos fechas seleccionadas es: $1000.</p>
                            </div>
                        </nav>
                        <div class="col col-xs-offset-3 col-xs-6">
                            <nav aria-label="Page navigation" class="text-center">
                                <ul class="pagination">
                                    <li>
                                        <a href="#" aria-label="Previous">
                                            <span aria-hidden="true">«</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" aria-label="Next">
                                            <span aria-hidden="true">»</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php include_once "footer.html" ;?>

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>   
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
<script src="js/jquery-1.0.4.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/ganancias.js"></script>
</html>

