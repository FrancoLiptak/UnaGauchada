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

    return getGauchadas(1, 0, "idGauchadas = $idGauchadas")->fetch_assoc();
}

function showGauchadaForAll($gauchada)
{
    $user = getUser($gauchada['idUser'])->fetch_assoc();
    $cate = getCategory($gauchada['idCategory'])->fetch_assoc();
    $city = getCity($gauchada['idCity'])->fetch_assoc();
    $hoy = date("Y-m-d");

        ?>
        <tr> 
            <td><img class="img-thumbnail img-table"src="<?php if($gauchada['image'] == null) { echo "uploads/63229-logoUnaGauchada.png"; }else { echo $gauchada['image']; }?>"></td>
            <td><?php echo ($user['name'] . " " . $user['surname'] ) ; ?></td>
            <td><?php echo $cate['name']; ?></td>
            <td><?php echo $city['name']; ?></td>
            <td><?php echo $gauchada['title']; ?></td>
            <td><?php echo date_diff(date_create($gauchada['expiration']), date_create($hoy))->format('%a'); ?></td>
            <td><a class="details" href="gauchadaVer.php?idGauchadas=<?php echo $gauchada['idGauchadas']; ?>">&raquo; Ver detalle</a>
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

function showGauchadaForAllPrueba($gauchada)
{
    $user = getUser($gauchada['idUser'])->fetch_assoc();
    $cate = getCategory($gauchada['idCategory'])->fetch_assoc();
    $city = getCity($gauchada['idCity'])->fetch_assoc();
    $hoy = date("Y-m-d");
    $maxStrLength = 40;
    $largo = false;

    if (strlen($gauchada['title']) > $maxStrLength){
        $largo=true;
    }
    $title = substr($gauchada['title'], 0, $maxStrLength);
    if ($largo) {
        $title = $title . "...";
    }
?>
        <div class="col-xs-6 col-md-4 gauchadaBox" >
            <div style="height: 60px" >
                <h3><?php echo $title ?></h3>
            </div>
            <p><span class="glyphicon glyphicon-user" ></span> <?php echo ($user['name'] . " " . $user['surname'] ) ; ?></p>
            <p>Categoria: <?php echo $cate['name']; ?></p>
            <p>Ciudad: <?php echo $city['name']; ?></p>
            <p>Expira en: <?php echo date_diff(date_create($gauchada['expiration']), date_create($hoy))->format('%a'); ?></p>
            <p></p>
            <p><a class="btn btn-default" href="gauchadaVer.php?idGauchadas=<?php echo $gauchada['idGauchadas']; ?>" role="button">Ver detalle &raquo;</a></p>
        </div><!--/.col-xs-6.col-lg-4-->
<?php

        // <td><img class="img-thumbnail"src="<?php if($gauchada['image'] == null) { echo "uploads/63229-logoUnaGauchada.png"; }else { echo $gauchada['image']; }?>
    <?php 
    }

function showOneGauchada($gauchada)
{   
    $user = getUser($gauchada['idUser'])->fetch_assoc();
    $cate = getCategory($gauchada['idCategory'])->fetch_assoc();
    $city = getCity($gauchada['idCity'])->fetch_assoc();
    $hoy = date("Y-m-d");

        ?>
            <img class="img-thumbnail"src="<?php if($gauchada['image'] == null) { echo "uploads/63229-logoUnaGauchada.png"; }else { echo $gauchada['image']; }?>">
            <?php echo ($user['name'] . " " . $user['surname'] ) ; ?>
            <img class="img-thumbnail"src="<?php if($user['photo'] == null) { echo "uploads/nophoto.png"; }else { echo $user['photo']; }?>">
            <?php echo $cate['name']; ?>
            <?php echo $city['name']; ?>
            <?php echo $gauchada['title']; ?>
            <?php echo $gauchada['description']; ?>
            <?php echo date_diff(date_create($gauchada['expiration']), date_create($hoy))->format('%a'); ?>
    <?php 
    }


?>