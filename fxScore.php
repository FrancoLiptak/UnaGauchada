<?php
include_once 'connect.php';
include_once 'gauchadasFx.php';

function newScore($idGauchada, $rep, $description)
{
    $link = connect();
    if (validateGauchada($idGauchada)) {
        $query = "INSERT INTO score (idGauchadas, points, description)";
        $query = $query."VALUES ($idGauchada, $rep, '$description')";
        if ($result = $link->query($query)) {
            $_SESSION['success'] = "Se puntuo correctamente.";
            return $result;
        }
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function hasScore($idGauchada)
{
    return getScoreForGauchada($idGauchada)->num_rows>0;    
}

function getScoreForGauchada($idGauchada)
{
    $link = connect();
    if (validateGauchada($idGauchada)) {
        $query = "SELECT * FROM score WHERE idGauchadas=$idGauchada";
        if ($result = $link->query($query)) {
            return $result;
        }
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function getScore($idScore){
    $link = connect();
    if (validate($idScore)) {
        $query = "SELECT * FROM score WHERE idScore=$idScore";
        if ($result = $link->query($query)) {
            return $result;
        }
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function showScore($score){
    $idScore = $score['idScore'];           // Tiene el id del score, no lo van a necesitar.
    $idGauchada = $score['idGauchadas'];    // Tiene el id de la gauchada, no lo van a necesitar.
    $reputation = $score['points'];         // Puede ser -2, 0 o 1. Es el cambio en reputacion.
    $description = $score['description'];   // Puede ser vacio o texto. Es la nota que va con el puntaje.

    ?>
   <div class="panel panel-success">
        <div class="panel-heading">Has sido calificado</div>
            <table class="table table-bordered table-hover table-responsive">
                <tr>
                    <td>Descripción</td>
                    <td><?php echo $description; ?></td>
                </tr>
                <tr>
                    <td>Puntos</td>
                    <td><?php echo $reputation; ?></td>
                </tr>
            </table>
        </div>
        
    <?php
}
