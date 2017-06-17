<?
include 'validate.php';

function newHelp($idUser, $idGauchada, $description = "")
{
    if (validateUser($idUser) && validateGauchada($idGauchada)) {
        $link = connect();
        $query = "INSERT INTO help ( idUser, idGauchada, description ) ";
        $query = $query."VALUES ( $idUsers, $idGauchada, '$description');";
        if ($result = $link->query($query)) {
            return $result;
        }
        $_SESSION['msg'] = $link->error;
    }
    return false;
}

function getHelps($idGauchada)
{
    if(validateGauchada($idGauchada)){
        $link = connect();
        $query = "SELECT * FROM help WHERE idGauchada = $idGauchada;";
        $result = $link->query($query);
        return $result;
    }
    return false;
}