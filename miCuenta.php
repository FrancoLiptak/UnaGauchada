<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $name." ".$surname;?><span class="caret"></span></a>
    <ul class="dropdown-menu gray">
        <li><a target="_self" href="perfil.php"><span class="glyphicon glyphicon-user"></span> Mi perfil </a></li>
        <?php
        if ($_SESSION['admin']) {
                ?>
            <li><a target="_self" href="logros.php"><span class="glyphicon glyphicon-star-empty"></span> Ver logros </a></li>
            <li><a target="_self" href="categorias.php"><span class="glyphicon glyphicon-tags"></span> Ver categorias</a></li>
            <li><a target="_self" href="usersRanking.php"><i class="fa fa-users" aria-hidden="true"></i> Ranking de usuarios</a></li>
            <li><a target="_self" href="ganancias.php"><i class="fa fa-money" aria-hidden="true"></i> Ver ganancias</a></li>
            <?php
        } else {
                ?>
            <li><a target="_self" href="misGauchadas.php"><span class="glyphicon glyphicon-triangle-right"></span> Mis gauchadas</a></li>
            <li><a target="_self" href="helped.php"><span class="glyphicon glyphicon-thumbs-up"></span> Mis postulaciones </a></li>
            <li><a target="_self" href="comprarCreditos.php"><span class="glyphicon glyphicon-credit-card"></span> Comprar creditos </a></li>
                <?php
        }
?>
        <li role="separator" class="divider"></li>
        <li><a target="_self" href="editarPerfil.php"><span class="glyphicon glyphicon-cog"></span> Editar perfil </a></li>
        <li><a target="_self" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesion </a></a></li>
    </ul>
</li>
