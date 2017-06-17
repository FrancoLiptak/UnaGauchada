<?
include 'validate.php';

function getLogros()
{
    $link = connect();
    $query = "SELECT * FROM logros ORDER BY min";
    if ($result = $link->query($query)) {
        return $result;
    }
    $_SESSION['msg'] = $link->error;
    return false;
}

function calculateLogro($user)
{
    $logros = getLogros();
    $iLogros = $logros->num_rows;
    while($row = $logros->fetch_assoc()) {
        if ($user['reputation'] > $row['min']) {
            return $row['idLogros'];
        }
    }
}