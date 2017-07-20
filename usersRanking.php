<?php 
include_once 'validate.php';
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
?>

<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/ganancias.css">    
    <?php include_once "header.php";?>
    <link rel="stylesheet" href="css/bootstrap.min.css">

      
    <title>Ganancias</title>
    <br><br><br><br><br>
</head>
<div class="container">
    <div class="row">
        <nav class="navbar navbar-default">
            <div class="container">
                <div class="navbar-header">
                    <span class="navbar-brand">Ranking de usuarios</span>
                </div>
                <p class="navbar-text">En esta sección, usted podrá ver todos los usuarios registrados en unaGauchada, organizados según su reputación.</p>
            </div>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default panel-table">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class='col-md-3'>
                            <p class="centered">Resultados por página<p>
                            <div class="form-group">
                                <input type='number' class="form-control" placeholder="Ingrese cantidad" />
                            </div>
                        </div>
                        <div class='col-md-3'>
                            <p class="centered">Orden de visualización según reputación<p>
                            <div class="form-group centered">
                                <button type="button" title="Orden descendente" class="btn btn-default glyphicon glyphicon-arrow-down"></button>
                                <button type="button" title="Orden ascendente" class="btn btn-default glyphicon glyphicon-arrow-up"></button>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                            
                <div class="panel-body">
                    <table id="mytable" class="table table-striped table-bordered table-list">
                        <thead>
                        <tr>
                            <th class="col-text centered">Nombre</th>
                            <th class="col-text centered">Apellido</th>
                            <th class="col-text centered">Logro</th>
                            <th class="col-text centered">Reputación</th>
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
                        <div class="col col-xs-offset-3 col-xs-6">
                            <nav aria-label="Page navigation" class="text-center">
                                <ul class="pagination">
                                    <li>
                                        <a href="#" aria-label="Previous">
                                            <span aria-hidden="true">«</span>
                                        </a>
                                    </li>
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
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


<script src="js/moment.min.js"></script>  
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script src="js/jquery-1.0.4.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/ganancias.js"></script>
</html>