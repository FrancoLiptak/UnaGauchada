<html>

<head>
    <?php
        session_start();
        include_once 'validate.php';
        include_once 'fxHelp.php';
        include_once 'gauchadasFx.php';

        if (!validateLogin()) {
            $_SESSION['msg'] = "No estas logueado! No podes acceder a ver las gauchadas en las que ayudaste.";
            header('Location: index.php');
            die;
        }
        ?>
        <link rel="stylesheet" href="css/verAyudas.css" type="text/css" media="all" />
        <title>Postulaciones</title>

  <script src='js/jquery.min.js' type='text/javascript'/>
  <script src="js/jquery-1.0.4.js"></script>
</head>

<body>

	<?php
        $idUser = $_SESSION['idUsers'];

        $AllHelps = getUserHelp($idUser);		//Todas las gauchadas en las que me postule.
		$all = array();
        $accepted = array();					//Las que me aceptaron.
        $rejected = array();					//Las que me rechazaron.
        $pending = array();						//Las que no tienen ningun aceptado.

        while ($help = $AllHelps->fetch_assoc()) {
				$all[] = $help;
            if ($hasAccepted = hasAccepted($help['idGauchada'])) {
                if ($hasAccepted == $idUser) {
                    $accepted[] = $help;
                } else {
                    $rejected[] = $help;
                }
            } else {
                $pending[] = $help;
            }
        }

    ?>

    <div class="row">
                <div class="container-fluid  col-md-4 col-md-offset-4 ph">
                    <div class="page-header">
                        <h3 style="text-align:center;">Mis postulaciones</h3>
                    </div>
                </div>
    </div>
    <br>
    <div class="col-md-12">
                <div class="container">
                    <div class="row">
                        <div class="centered helpedButtons">
                        	<button type="button" class="btn btn-default btn-filter" href="#" id="buttonAll">Todas</button>
                        	<button type="button" class="btn btn-success btn-filter" href="#" id="buttonAccepted">Aceptadas</button>
                        	<button type="button" class="btn btn-warning btn-filter" href="#" id="buttonPending">Pendientes</button>
                        	<button type="button" class="btn btn-danger btn-filter" href="#" id="buttonRejected">Rechazadas</button>
                        </div>
                        <br>
                        <div id="all" style="display:none"><?php showGauchadas($all); ?></div>
                        <div id="accepted" style="display:none"><?php showGauchadas($accepted); ?></div>
                        <div id="pending" style="display:none"><?php showGauchadas($pending); ?></div>
                        <div id="rejected" style="display:none"><?php showGauchadas($rejected, false); ?></div>
                        <?php
                        function showGauchadas($state, $enabledLink = true){
                        	foreach ($state as $i => $value) {
                        		$gauchada = getOneGauchada($state[$i]['idGauchada']);
                        		showGauchadaForAllPrueba($gauchada, $enabledLink);
                        	}
                        }
                        ?>
                    </div>
                </div>
    </div>
</body>
<script type="text/javascript" src="js/helped.js"></script>
<?php include_once "header.php"; include("footer.html");?>
</html>