<?php

include_once 'connect.php';
include_once 'usersFx.php';
include_once 'fxCategory.php';
include_once 'fxCity.php';
include_once 'fxProvince.php';
include_once 'fxHelp.php';
function getGauchadas($limit, $first, $condition = "1 = 1")
{
// Retorna las proximas $limit gauchadas comenzando desde la tupla numero $first que cumplen la condicion $condition.

$link = connect();
$query = "SELECT * FROM gauchadas WHERE " . $condition . " order by idGauchadas desc LIMIT $first, $limit ";
$result = $link->query($query);
if (!$result) {
printf("Errormessage: %s\n", $link->error);
return false;
}
return $result;
}

function getOneGauchada($idGauchadas)
{
// Retorna la gauchada con idGauchada = $idGauchada.

return getGauchadas(1, 0, "idGauchadas = $idGauchadas")->fetch_assoc();
}

function showGauchadaForAllPrueba($gauchada, $enabledLink = true)
{
$user = getUser($gauchada['idUser'])->fetch_assoc();
$cate = getCategory($gauchada['idCategory'])->fetch_assoc();
$city = getCity($gauchada['idCity'])->fetch_assoc();
$prov = getProv($city['idProvince'])->fetch_assoc();
$hoy = date("Y-m-d");
$maxStrLength = 40;
$largo = false;

if (strlen($gauchada['title']) > $maxStrLength) {
$largo=true;
}
$title = substr($gauchada['title'], 0, $maxStrLength);
if ($largo) {
$title = $title . "...";
}
?>
        <div class="col-md-4">
            <div class="col-md-11 gauchadaBox">
                <div class="box-main" style="text-align:left;">
                    <legend class="box-title">
                        <?php echo $title ?>
                    </legend>
                </div>
                <p class="" style="text-align:left;">
                    <img class="img-circle img-table-user" src="<?php if ($user['photo'] == null) {
                        echo " uploads/nophoto.png ";
                        } else {
                        echo $user['photo'];
                        }?>">
                    <?php echo ($user['name'] . " " . $user['surname']) ; ?>
                </p>

                <img class="img-thumbnail img-table" src="<?php if ($gauchada['image'] == null) {
                    echo " uploads/63229-logoUnaGauchada.png ";
                    } else {
                    echo $gauchada['image'];
                    }?>">

                <div class="row" style="text-align:left; margin-left:20px;">
                    <p>
                        <span class="glyphicon glyphicon-hourglass box-item"></span>
                        <?php
                        if ($gauchada['finished']){
                            echo "Terminada";
                        }
                        else {
                            echo date_diff(date_create($gauchada['expiration']), date_create($hoy))->format('%a'); ?> días restantes.
                        <?php                            
                        }
                        ?>
                    </p>
                    <p> <span class="glyphicon glyphicon-tags box-item"></span>
                        <?php echo $cate['name']; ?> </p>
                    <p> <span class="glyphicon glyphicon-map-marker box-item"></span>
                        <?php echo $prov['name'].", ".$city['name'] ?> </p>
                </div>
                <?php
                    if( $enabledLink == true ){
                    ?>
                         <p><a class="btn btn-default" id="submit" href="gauchadaVer.php?idGauchadas=<?php echo $gauchada['idGauchadas']; ?>"
                        role="button">Ver detalle &raquo;</a></p>
                    <?php
                    }
                ?>
            </div>
        </div>
        <!--/.col-xs-6.col-lg-4-->
        <?php

// <td><img class="img-thumbnail"src="<?php if($gauchada['image'] == null) { echo "uploads/63229-logoUnaGauchada.png"; }else { echo $gauchada['image']; }?>
            <?php
}

function showOneGauchada($gauchada)
{
$user = getUser($gauchada['idUser'])->fetch_assoc();
$cate = getCategory($gauchada['idCategory'])->fetch_assoc();
$city = getCity($gauchada['idCity'])->fetch_assoc();
$prov = getProv($city['idProvince'])->fetch_assoc();
$hoy = date("Y-m-d");

?>
    <div class="centered">
        <div class="page-header" style="margin-top:0px;">
            <h2>
                <?php echo $gauchada['title']; ?>
            </h2>
        </div>
        <div class="col-md-6">
            <img class="img-thumbnail img-detail" src="
                <?php
                if ($gauchada['image'] == null) {
                echo " uploads/63229-logoUnaGauchada.png ";
                } else {
                echo $gauchada['image'];
                }
                ?> 
                "> <br><br>
        </div>
        <div class="col-md-6" style="margin-top: 40px">
            <p>
                <img class="img-circle img-table-user" src="
                    <?php
                    if ($user['photo'] == null) {
                    echo " uploads/nophoto.png ";
                    } else {
                    echo $user['photo'];
                    }
                    ?>
                    ">
                <?php echo ($user['name'] . " " . $user['surname'] ) ; ?>

            </p>
            <p class="centered">
                <span class="glyphicon glyphicon-tags box-item"></span>&nbsp;
                <?php echo $cate['name']; ?>
                <span class="glyphicon glyphicon-map-marker box-item"></span>
                <?php echo $prov['name'].", ".$city['name']; ?>
                <br>
                <p><span class="glyphicon glyphicon-hourglass box-item"></span>
                    <?php 
                        if (($restantes = date_diff(date_create($gauchada['expiration']), date_create($hoy))->format('%a')) >= 0) {
                            echo $restantes." días restantes.";
                        }
                        else {
                            echo "La gauchada ya expiro!";
                        }
                    ?>
                </p>
            </p>
            <div class="col-md-12">
                <?php
                if (isset($_SESSION['idUsers'])) {
                    if ($_SESSION['idUsers']== $gauchada['idUser']) {
                        ?>
                        <div class="col-md-6">
                            <a class="btn btn-success" id="submit" href="" role="button"><span class="glyphicon glyphicon-edit"></span> Editar </a>
                        </div>
                        <div class="col-md-6">
                            <a class="btn btn-danger" id="submit" href="" role="button"> <span class="glyphicon glyphicon-trash"></span> Eliminar </a>
                        </div>
                        <?php
                    }
                    elseif ($_SESSION['admin']) { 
                        ?>
                        <div>
                            <a class="btn btn-danger" id="submit" href="" role="button"><span class="glyphicon glyphicon-trash"></span> Eliminar </a>
                        </div>
                        <?php
                    }
                }
            ?>
            </div>
            <!-- de los botones -->
        </div>
        <div class="col-md-12" style="margin-bottom:">
            <div class="page-header" style="margin: 30px">

            </div>
            <div style="margin: 30px">
                <h4 style="text-align: left;">
                    <?php echo $gauchada['description']; ?>
                </h4>
            </div>
        </div>
    <?php
    if (validateLogin()) {
        ?>
        <div class="col-md-12">
            <?php
            $loggedUser = $_SESSION['idUsers'];
            $gauchadaUser = $gauchada['idUser'];
            $gauchadaId = $gauchada['idGauchadas'];

            if ($loggedUser == $gauchadaUser) {
                listHelps($gauchadaId);
            }
            elseif (!isAdmin()){
                if ($acceptedUser = hasAccepted($gauchadaId)) {
                    if ($acceptedUser == $loggedUser) {
                        echo "Felicitaciones! Tu solicitud de ayuda fue aceptada.";
                    }
                    elseif (getOneHelp($gauchadaId, $loggedUser)->num_rows > 0) {
                        echo "Lo sentimos, otro postulante fue elegido para esta gauchada :(";                    
                    }
                }
                elseif (getOneHelp($gauchadaId, $loggedUser)->num_rows == 0) {
                    ?>

                    <div style="margin-bottom: 50px;">
                        <a href="#" class="col-md-6 col-md-offset-3 btn btn-warning" onclick="style.display = 'none'; formAyuda.style.display = 'block'">
                          Me interesa ayudar en ésta publicación
                        </a>
                        
                        <form action="newHelp.php" method="post" style="display:none" id="formAyuda">
                                <div class="form-group col-md-9"> 
                                    <input type="text" name="idGauchadas" hidden value="<?php echo $gauchada['idGauchadas']; ?>">
                                    <textarea style="width:100%;"class="form-control" name="description" placeholder="Envía una descripción opcional de por qué quieres ayudar"></textarea>
                                </div>
                               
                                <button type="submit" class="btn btn-warning ir col-md-3"><span class="glyphicon glyphicon-thumbs-up"></span> Postularme</button>
                        </form>

                    <?php
                }
                elseif (getOneHelp($gauchadaId, $loggedUser)->num_rows > 0) {
                    ?>
                    <form action="deleteHelp.php" method="post" style="margin-bottom: 22px;">
                        <input type="text" name="idGauchadas" hidden value="<?php echo $gauchada['idGauchadas']; ?>"><br>
                        <button type="submit" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar Postulación</button>
                    </form>

                    <?php
                }
            }
            ?>
        </div>
        <?php
    }
    ?> 
    </div>
    <!-- del centered div -->
    <?php
}

function finishGauchada($idGauchada){
    $link = connect();
    if (validateGauchada($idGauchada)) {
        $query = "UPDATE gauchadas SET finished=1 WHERE idGauchadas=$idGauchada";
        if ($link->query($query)) {
            return true;
        }
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function isExpired($gauchada)
{
    return $gauchada['expiration'] < date('Y-m-d');
}
?>