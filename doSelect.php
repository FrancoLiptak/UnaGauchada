<?php
include_once "connect.php";
function doSelect($table)
{
    $link = connect();
    $query = "SELECT * FROM ".$table.";";
    if ($result = $link->query($query)) {
        $i = $result->num_rows;

        while ($row = $result->fetch_array(MYSQLI_NUM)) {
            ?>

            <option class="fondoGaucho" value="<?php echo($row[0]); ?>" > <?php echo($row[1]); ?> </option>

<?php
        }
    }
    mysqli_close($link);
}
function selectCity()
{
    $link = connect();
    $query = "SELECT * FROM city;";
    $resultProv = "SELECT * FROM province;";
    $resultProv = $link->query($resultProv);
    while ($row = $resultProv->fetch_assoc()) {
        $provArray[$row['idProvince']]['id'] = $row['idProvince'];
        $provArray[$row['idProvince']]['name'] = $row['name'];
    }
    if ($result = $link->query($query)) {

        while ($row = $result->fetch_assoc()) {
            ?>

            <option class="fondoGaucho" value="<?php echo($row['idCity']); ?>" > <?php echo $provArray[$row['idProvince']]['name'].", ".$row['name'] ; ?> </option>

<?php
        }
    }
    mysqli_close($link);
}
function selectCates()
{
// IMPORTANTE Solo llamar dentro de un select.
// Crea opciones para todas las categorias.
    doSelect('category');
}

?>
