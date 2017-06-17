<?
include 'validate.php';

function newHelp($idUser, $idGauchada, $description = "")
{
    if (validateUser($idUser) && validateGauchada($idGauchada)) {
        $link = connect();
        $query = "INSERT INTO help ( idUser, idGauchada, description ) ";
        $query = $query."VALUES ( $idUsers, $idGauchada, '$description');";
        if ($result = $link->query($query)) {
            return $true;
        }
        $_SESSION['msg'] = $link->error;
        return false;
    }
}
