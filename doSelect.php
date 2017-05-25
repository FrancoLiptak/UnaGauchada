<?php
    include_once "connect.php";
    function doSelect($table) {
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
    function selectCity(){
        doSelect('city');
    }
    function selectCates(){
        // IMPORTANTE Solo llamar dentro de un select.
        // Crea opciones para todas las categorias.
        doSelect('category');
    }

?>