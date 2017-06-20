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

  <script src='js/jquery.min.js' type='text/javascript'/>
  <script src="js/jquery-1.0.4.js"></script>
</head>

<body>

	<?php
        $idUser = $_SESSION['idUsers'];

        $AllHelps = getUserHelp($idUser);

        $accepted = array();
        $rejected = array();
        $pending = array();

        while ($help = $AllHelps->fetch_assoc()) {
            if ($hasAccepted = hasAccepted($help['idGauchada'])) {
                if ($hasAccepted = $idUser) {
                    $accepted[] = $help;
                } else {
                    $rejected[] = $help;
                }
            } else {
                $pending[] = $help;
            }
        }

    ?>

<div class="container helped">
	<div class="row">

		<section class="content">
			<h1>Gauchadas en las que ofreciste ayuda</h1>
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="centered helpedButtons">
							<button type="button" class="btn btn-default btn-filter" data-target="all">Todas</button>
							<button type="button" class="btn btn-success btn-filter" data-target="onaylanan">Aceptadas</button>
							<button type="button" class="btn btn-warning btn-filter" data-target="bekleyen">Pendientes</button>
							<button type="button" class="btn btn-danger btn-filter" data-target="iptal">Rechazadas</button>
						</div>
						<div class="table-container">
							<table class="table table-filter">
								<tbody>
									<?php
										foreach ($accepted as $i => $value) {
									?>
									<tr data-status="bekleyen">
										<td>
											<div class="media centered">
												<?php
													$gauchada = getOneGauchada($accepted[$i]['idGauchada']);
												?>
													<H3><?php echo $gauchada['title']; ?> </H3>
													<img src=<?php echo '"'.$gauchada[ 'image']. '"'; ?>>
													<br><br>
													<p><?php echo $gauchada['description']; ?></p>
													</div>
												</td>
											</tr>
									<?php
										}
									?>
									<?php
										foreach ($rejected as $i => $value) {
									?>
									<tr data-status="bekleyen">
										<td>
											<div class="media centered">
												<?php
													$gauchada = getOneGauchada($rejected[$i]['idGauchada']);
												?>
													<H3><?php echo $gauchada['title']; ?> </H3>
													<img src=<?php echo '"'.$gauchada[ 'image']. '"'; ?>>
													<br><br>
													<p><?php echo $gauchada['description']; ?></p>
													</div>
												</td>
											</tr>
									<?php
										}
									?>
									<?php
										foreach ($pending as $i => $value) {
									?>
									<tr data-status="bekleyen">
										<td>
											<div class="media centered">
												<?php
													$gauchada = getOneGauchada($pending[$i]['idGauchada']);
												?>
													<H3><?php echo $gauchada['title']; ?> </H3>
													<img src=<?php echo '"'.$gauchada[ 'image']. '"'; ?>>
													<br><br>
													<p><?php echo $gauchada['description']; ?></p>
													</div>
												</td>
											</tr>
									<?php
										}
									?>
											
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
		
        
	</div>
</div>


</body>
<script type="text/javascript" src="js/verAyudas.js"></script>
<?php include_once "header.php"; include("footer.html");?>
</html>