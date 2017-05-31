<?php function hacerAlert($msj, $type = "danger")
{

        // Realiza un alert del tipo que se parametrice, y con el msj que se mande.
    ?>
<div class="col-md-6 col-md-offset-3 alert alert-<?php echo $type; ?> alert-dismissable" style="">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong> Nota: </strong>
    <span> <?php echo $msj; ?> </span>
</div>
<?php
}
    ?>
