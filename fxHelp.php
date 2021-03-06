<?php
include_once  'validate.php';
include_once 'gauchadasFx.php';
include_once 'usersFx.php';
include_once 'credits.php';
include_once 'gauchadasFx.php';
include_once 'fxScore.php';
include_once 'fxLogros.php';

function newHelp($idUser, $idGauchada, $description = "")
{
    if (validateUser($idUser) && validateGauchada($idGauchada)) {
        $link = connect();
        $query = "INSERT INTO help (idUsers, idGauchada, description)";
        $query = $query."VALUES ($idUser, $idGauchada, '$description')";
        if ($result = $link->query($query)) {
            $_SESSION['success'] = "Te postulaste exitosamente!";
            return $result;
        }
        $_SESSION['msg'] = $link->error;
    }
    return false;
}

function getHelps($idGauchada)
{
    if (validateGauchada($idGauchada)) {
        $link = connect();
        $query = "SELECT * FROM help WHERE idGauchada = $idGauchada;";
        $result = $link->query($query);
        return $result;
    }
    return false;
}

function getOneHelp($idGauchada, $idUser)
{
    if (validateGauchada($idGauchada) && validateUser($idUser)) {
        $link = connect();
        $query = "SELECT * FROM help WHERE idGauchada = $idGauchada AND idUsers = $idUser;";
        $result = $link->query($query);
        return $result;
    }
    return false;
}

function deleteHelp($idGauchada, $idUser)
{
    if (validateGauchada($idGauchada) && validateUser($idUser)) {
        $link = connect();
        $query = "DELETE FROM help WHERE idUsers=$idUser AND idGauchada=$idGauchada";
        $result = $link->query($query);
        if ($result = $link->query($query)) {
            $_SESSION['success'] = "Tu postulacion fue eliminada.";
            return $result;
        }
        $_SESSION['msg'] = $link->error;
    }
    return false;
}

function acceptHelp($idGauchada, $idUser)
{
    if (validateGauchada($idGauchada) && validateUser($idUser)) {
        $link = connect();
        $query = "UPDATE help SET selected=1 WHERE idUsers=$idUser AND idGauchada=$idGauchada";
        if ($result = $link->query($query)) {
            if (finishGauchada($idGauchada)) {
                $_SESSION['success'] = "La ayuda fue aceptada.";
                return $result;
            }
        }
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function hasAccepted($idGauchada){
    $link = connect();
    if (validateGauchada($idGauchada)) {
        $query = "SELECT * FROM help WHERE idGauchada = $idGauchada AND selected=1;";
        $result = $link->query($query);
        if ($result && $result->num_rows > 0) {
            $result = $result->fetch_assoc();
            return $result['idUsers'];
        }
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function hasHelps($idGauchada)
{
    $ayudas = getHelps($idGauchada);
    $num_rows= $ayudas->num_rows;
    if ($num_rows > 0) 
        return true;
    else
        return false;

}
function listHelps($idGauchada)
{
    $accepted = hasAccepted($idGauchada);
    if ($ayudas = getHelps($idGauchada)) {
            $cant_ayudas= $ayudas->num_rows; ?>
            <div class="row">
            <?php 
            if ($cant_ayudas > 0) {
            ?>
                <legend><span class='badge'><?php echo $cant_ayudas ?></span>
            <?php
            if ($cant_ayudas > 1) {
                echo " Postulantes:";
            } else {
                echo " Postulante:";
            }?>
            </legend>
            <?php 
            } else {
                hacerAlertV2(" No hay postulantes hasta el momento.");
            }
            if ($cant_ayudas > 0) {
                ?>
                <div class="row" style="margin-bottom: 15"> 
                    <div class="col-md-3">
                        <p><strong>Usuario: </strong></p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Logro y reputacion: </strong></p>
                    </div>
                    <div class="col-md-3">
                        <p><strong>Descripcion: </strong></p>
                    </div>
                    <div class="col-md-3">
                    
                    </div>
                </div>
                <?php
            }
            while ($help = $ayudas->fetch_assoc()) {
                $gauchada = getOneGauchada($help['idGauchada']);
                $user = getUser($help['idUsers'])->fetch_assoc();
                ?>
                <div class="row">
                    <div class="col-md-3">
                        <p>
                            <?php
                            if($help['idUsers'] ==  $user['idUsers'] and $help['selected'] == 1){
                                ?>
                                <span class="delay-2 animated flash">
                                    <span style="color: green; font-size:6px;" class="glyphicon glyphicon-pushpin"></span>
                                    <span> <?php echo $user['name']." ".$user['surname'].". " ?></span>
                                </span>
                                <?php 
                            }else{
                             echo $user['name']." ".$user['surname'].". " ;
                             }
                             ?>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p>
                            <?php echo logroConRep($user); ?>
                        </p>
                    </div>
                    <div class="col-md-3">
                        <p>
                            <?php if($help['description']) echo $help['description']; else echo "---";?>
                        </p>
                    </div>
                        <?php
                        if (!$accepted) {
                            ?>
                            <div class="col-md-3">
                                    <form action="acceptHelp.php" method="post" class="">
                                        <input type="text" name="idUsers" value="<?php echo $help['idUsers'] ?>" hidden>
                                        <input type="text" name="idGauchadas" value="<?php echo $help['idGauchada'] ?>" hidden>
                                        <button type="submit" class="btn btn-warning" style="<?php if(!($help['description'])) {?> margin-bottom: 20px; <?php } else{?> margin-bottom: 8px; <?php } ?>"><span class="glyphicon glyphicon-ok-circle"></span> Aceptar Ayuda</button>
                                    </form>
                            </div>
                            <?php
                        }
                        elseif ($help['idUsers'] == $accepted) {
                            if (hasScore($help['idGauchada'])) {
                                $score = getScoreForGauchada($idGauchada)->fetch_assoc();
                                ?>
                                <script type="text/javascript">
                                function switchDesc(){
                                    if (down.style.display == 'none') {
                                        down.style.display = 'inline';
                                        up.style.display = 'none';
                                        desc.style.display = 'none';
                                    } else { 
                                        down.style.display = 'none';
                                        up.style.display = 'inline';
                                        desc.style.display = 'block';
                                    }
                                }
                                </script>
                                <div class="col-md-3">
                                    <a href="#!" class="btn btn-default" onclick="return switchDesc();">
                                        <span>Calificación</span>
                                        <span style="display:inline"id="down" class="glyphicon glyphicon-chevron-down"></span>
                                        <span style="display:none"id="up" class="glyphicon glyphicon-chevron-up"></span>
                                    </a>
                                </div>

                                <br><br>
                                <div class="col-md-12 well" style="display:none; text-align:left;" id="desc">
                                    <div Class="col-md-8 col-md-offset-2">
                                    <p class="">
                                        <?php  if($score['description'] == null) echo "• No se ha hecho ningún comentario acerca de la participación de ".$user['name'];  else echo "• Comentario acerca de la participación de ".$user['name'].": ".$score['description'];
                                        echo "<br>• Calificación: ";
                                        switch ($score['points']) {
                                        case -2:
                                            ?>
                                            <span style="color: red" class="glyphicon glyphicon-thumbs-down"></span> <?php echo "(Mala)" ?>
                                            <?php 
                                            break;
                                        case 0:
                                            ?>
                                            <span style="color: orange" class="glyphicon glyphicon-thumbs-up"></span><span style="color: orange" class="glyphicon glyphicon-thumbs-down"></span> <?php echo "(Neutra)" ?>
                                            <?php
                                            break;
                                        case 1:
                                            ?>
                                            <span style="color: green" class="glyphicon glyphicon-thumbs-up"></span> <?php echo "(Buena)" ?>
                                            <?php
                                            break;}
                                        ?>
                                    </p>
                                    </div>
                                </div>

                            <?php 
                            }
                            elseif (isExpired($gauchada)) {
                                ?>

                            <div>
                                <a href="#!" class="btn btn-warning" onclick="style.display = 'none'; formPuntuar.style.display = 'block'">Calificar</a>
                            </div>
                            <div class="col-md-12">
                            <br>
                            <form method="post" action="score.php" style="display:none" id="formPuntuar">
                                    <div class="form-group col-md-6"> 
                                        <input type="text" name="idGauchadas" hidden value="<?php echo $gauchada['idGauchadas']; ?>">
                                        <input type="text" name="idUser" hidden value="<?php echo $help['idUsers']; ?>">
                                        <textarea style="width:100%;"class="form-control" rows="3" name="description" placeholder="Envía una descripción OPCIONAL acerca de la participación de <?php echo $user['name']." ".$user['surname']; ?>"></textarea>
                                    </div>
                                    <div class="form-group col-md-3"> 
                                        <input type="radio" name="score" value="0">&nbsp;&nbsp;&nbsp; <span style="color: red" class="glyphicon glyphicon-thumbs-down"></span> <br>
                                        <input type="radio" name="score" value="1" checked> <span style="color: orange" class="glyphicon glyphicon-thumbs-up"></span><span style="color: orange" class="glyphicon glyphicon-thumbs-down"></span><br>
                                        <input type="radio" name="score" value="2">&nbsp;&nbsp;&nbsp; <span style="color: green" class="glyphicon glyphicon-thumbs-up"></span>
                                    </div>                                 
                                    <button type="submit" name="submit" class="btn btn-warning ir col-md-3"> Calificar</button>
                            </form>
                            </div>
                            <?php
                            }
                            else {?>
                            <script type="text/javascript">
                                function switchInfoCalificar(){
                                    if (infoCalificar.style.display == 'block') {
                                        infoCalificar.style.display = 'none';
                                    } else { 
                                        infoCalificar.style.display = 'block';
                                    }
                                }
                                </script>

                                <div class="col-md-3">
                                    <button onclick="return switchInfoCalificar();" type="submit" name="submit" class="btn btn-success" style="margin-bottom: 8px;" title="Click para ver info."> 
                                        <span class="glyphicon glyphicon-ok-circle"></span>
                                        Gaucho Elegido!
                                </button>
                                </div>
                                <br><br>
                                <div class="col-md-12 well" style="display:none; text-align:left;" id="infoCalificar">
                                    <div Class="col-md-10 col-md-offset-1 centered">
                                    <p class="">Podras calificar al gaucho elegido una vez caducada la gauchada.</p>
                                    </div>
                                </div>
                                <?php 
                            }
                        }
                        else {?>
                           <div class="col-md-3">
                            <p>Rechazado/a</p>
                           </div>
                        <?php 
                        }
                        ?>
                </div>
            <?php
            }
        ?>
        </div>
        <?php
    }
}

function getUserHelp($idUser){
    if (validateUser($idUser)) {
        $link = connect();
        $query = "SELECT * FROM help WHERE idUsers = $idUser;";
        $result = $link->query($query);
        return ($result);
    }
    return false;
}




?>