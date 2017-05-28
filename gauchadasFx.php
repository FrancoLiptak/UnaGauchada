<?php

    include_once 'connect.php';
    include_once 'usersFx.php';
    include_once 'fxCategory.php';
    include_once 'fxCity.php';
function getGauchadas($limit, $first, $condition = "1 = 1")
{
    // Retorna las proximas $limit gauchadas comenzando desde la tupla numero $first que cumplen la condicion $condition.

    $link = connect();
    $query = "SELECT * FROM gauchadas WHERE " . $condition . " order by idGauchadas desc LIMIT $first, $limit ";
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
            <div class="centered box-main">
                <legend class="box-title"><?php echo $title ?></legend>
                <img class="img-thumbnail img-table"src="<?php if($gauchada['image'] == null) { echo "uploads/63229-logoUnaGauchada.png"; }else { echo $gauchada['image']; }?>">
            </div>
            <p class="centered">
             <img class="img-thumbnail img-table-user"src="<?php if($user['photo'] == null) { echo "uploads/nophoto.png"; }else { echo $user['photo']; }?>">
             <?php echo ($user['name'] . " " . $user['surname']) ; ?>
            </p>
            <p class="centered">
                <span class="glyphicon glyphicon-hourglass box-item"></span><?php echo date_diff(date_create($gauchada['expiration']), date_create($hoy))->format('%a'); ?> días restantes.
           </p>
            <p><a class="btn btn-default" id="submit" href="gauchadaVer.php?idGauchadas=<?php echo $gauchada['idGauchadas']; ?>" role="button">Ver detalle &raquo;</a></p>
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
    <div class="centered">
        <div class="page-header" style="margin-top:0px;">
            <h2> <?php echo $gauchada['title']; ?></h2> 
        </div>
        <img class="img-thumbnail img-detail"src="<?php if($gauchada['image'] == null) { echo "uploads/63229-logoUnaGauchada.png"; }else { echo $gauchada['image']; }?>"></span>
        <div class="col-md-6 col-md-offset-3"> 
            <h3><?php echo $gauchada['description']; ?></h3>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <p>
                <img class="img-thumbnail img-table-user"src="<?php if($user['photo'] == null) { echo "uploads/nophoto.png"; }else { echo $user['photo']; }?>">
                <?php echo ($user['name'] . " " . $user['surname'] ) ; ?>
            </p>
            <p class="centered">
                <span class="glyphicon glyphicon-tags box-item"></span>&nbsp;<?php echo $cate['name']; ?>
                <span class="glyphicon glyphicon-map-marker box-item"></span><?php echo $city['name']; ?>
                <br><br>
                <span class="glyphicon glyphicon-hourglass box-item"></span><?php echo date_diff(date_create($gauchada['expiration']), date_create($hoy))->format('%a'); ?> días restantes.
           </p>
        </div>
           <div class="col-md-6 col-md-offset-3">
               <?php 
                    if(isset($_SESSION['idUsers'])){
                        if($_SESSION['idUsers']== $gauchada['idUser']){
                     ?>
                        <p><a class="btn btn-success" id="submit" href="" role="button"><span class="glyphicon glyphicon-edit"></span> Editar </a></p>
                        <p><a class="btn btn-danger" id="submit" href="" role="button"> <span class="glyphicon glyphicon-trash"></span> Eliminar </a></p>
                    <?php 
                        }
                    else{
                ?>
                    <p><a class="btn btn-warning" id="submit" href="" role="button">Ayudar &raquo;</a></p>
                <?php 
                    }}
                 ?>
            </div> <!-- de los botones -->
    </div> <!-- del centered div -->
    <?php 
    }


?>