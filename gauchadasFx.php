<?php

    include_once 'connect.php';
    include_once 'usersFx.php';
    include_once 'fxCategory.php';
    include_once 'fxCity.php';
function getGauchadas($limit, $first, $condition = "1 = 1")
{
    // Retorna las proximas $limit gauchadas comenzando desde la tupla numero $first que cumplen la condicion $condition.

    $link = connect();
    $query = "SELECT * FROM gauchadas WHERE " . $condition . " LIMIT $first, $limit";
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

    return getGauchadas(1, 1, "idGauchadas = $idGauchadas");
}

function showGauchadaForAll($gauchada)
{
    $user = getUser($gauchada['idUser'])->fetch_assoc();
    $cate = getCategory($gauchada['idCategory'])->fetch_assoc();
    $city = getCity($gauchada['idCity'])->fetch_assoc();
    $hoy = date("Y-m-d");

        ?>
        <tr> 
            <td><img class="img-thumbnail img-table img-responsive"src="<?php if($gauchada['image'] == null) { echo "uploads/63229-logoUnaGauchada.png"; }else { echo $gauchada['image']; }?>"></td>
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $cate['name']; ?></td>
            <td><?php echo $city['name']; ?></td>
            <td><?php echo $gauchada['title']; ?></td>
            <td><?php echo date_diff(date_create($gauchada['expiration']), date_create($hoy))->format('%a'); ?></td>
            <td><a class="details" href="detalle.php?idGauchadas=<?php echo $gauchada['idGauchadas']; ?>">&raquo; Ver detalle</a>
            <?php 
                if(isset($_SESSION['idUsers'])) { 
                    if($_SESSION['idUsers'] ==  $user['idUsers']){?>
                                    <br><br>
                                    <a class="edit" href=""><span class="glyphicon glyphicon glyphicon-edit" aria-hidden="true"></span> Editar</a>
                                    <br><br>
                                    <a onclick="return myFunction()" class="erase" href=""><span class="glyphicon glyphicon glyphicon-trash" aria-hidden="true"></span> Eliminar</a>
                                    <br>
                    <?php 
                    }
               }
           ?>

         </tr>
            </td>
    <?php 
    }
?>