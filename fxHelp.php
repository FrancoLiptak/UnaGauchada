<?php
include_once  'validate.php';
include_once 'gauchadasFx.php';
include_once 'usersFx.php';

function newHelp($idUser, $idGauchada, $description = "")
{
    if (validateUser($idUser) && validateGauchada($idGauchada)) {
        $link = connect();
        $query = "INSERT INTO help (idUsers, idGauchada, description)";
        $query = $query."VALUES ($idUser, $idGauchada, '$description')";
        if ($result = $link->query($query)) {
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

function deleteHelpFrom($idGauchada, $idUser)
{
    if (validateGauchada($idGauchada) && validateUser($idUser)) {
        $link = connect();
        $query = "DELETE FROM help WHERE idUsers=$idUser AND idGauchada=$idGauchada";
        $result = $link->query($query);
        return $result;
    }
    return false;
}

function listHelps($idGauchada)
{
    if ($ayudas = getHelps($idGauchada)) {
    }
?>
    <div class="col-md-12">
        <?php
        while ($help = $ayudas->fetch_assoc()) {
                $gauchada = getOneGauchada($help['idGauchada']);
                $user = getUser($help['idUsers'])->fetch_assoc();
                ?>
            <div class="row">
                <div class="col-md-4">
                    <p>
                        <?php echo $user['name']." ".$user['surname']; ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <p>
                        <?php echo $help['description']; ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <?php
                    if (isAdmin()) {
                            ?>
                            <form action="deleteHelp.php">
                                <input type="text" name="idUsers" value="<?php echo $help['idUsers'] ?>" hidden>
                                <input type="text" name="idGauchadas" value="<?php echo $help['idGauchada'] ?>" hidden>
                                <input type="submit" name="submit" value="Borrar ayuda">
                            </form>
                            <?php
                    }
                    else {
                        ?>
                            <form action="acceptHelp.php">
                                <input type="text" name="idUsers" value="<?php echo $help['idUsers'] ?>" hidden>
                                <input type="text" name="idGauchadas" value="<?php echo $help['idGauchada'] ?>" hidden>
                                <input type="submit" name="submit" value="Aceptar ayuda">
                            </form>
                        <?php
                    }
                ?>
                </div>
            </div>
        <?php
        }
    ?>
    </div>
    <?php
}
