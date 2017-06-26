<li class="dropdown">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $name." ".$surname;?><span class="caret"></span></a>
    <ul class="dropdown-menu gray">
        <?php
        if ($_SESSION['admin']) {
                ?>
            <li><a target="_self" href=""><span class="glyphicon glyphicon-star-empty"></span> Ver logros </a></li>
            <li><a target="_self" href=""><span class="glyphicon glyphicon-tags"></span> Ver categorias</a></li>
            <?php
        } else {
                ?>
            <li><a target="_self" href="comprarCreditos.php"><span class="glyphicon glyphicon-credit-card"></span> Comprar creditos </a></li>
            <li><a target="_self" href="helped.php"><span class="glyphicon glyphicon-thumbs-up"></span> Mis postulaciones </a></li>
            <li><a target="_self" href="misGauchadas.php"><span class="glyphicon glyphicon-triangle-right"></span> Mis gauchadas</a></li>
                <?php
        }
?>
        <li><a target="_self" href="perfil.php"><span class="glyphicon glyphicon-user"></span> Ver perfil </a></li>
        <li role="separator" class="divider"></li>
        <li><a target="_self" href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Cerrar sesion </a></a></li>
    </ul>
</li>
