<?php
    include_once 'connect.php';
    include_once 'gauchadasFx.php';
    include_once 'getUser.php';

function getComment($idComment)
{
    // Retorna los comentarios con la id solicitada.

    $link = connect();
    $query = "SELECT * FROM comments WHERE idComment = $idComment;";
    $result = $link->query($query);
    if (!$result) {
        printf("Errormessage: %s\n", $link->error);
        return false;
    }
    return $result;
}

function getCommentsForGauchada($idGauchada) {
    $link = connect();
    $query = "SELECT * FROM comments WHERE idGauchada = $idGauchada AND idReplied is NULL;";
    $result = $link->query($query);
    if (!$result) {
        printf("Errormessage: %s\n", $link->error);
        return false;
    }
    return $result;
}

function showComment($comment, $idGauchada, $isReply = false)
{
    $link = connect();
    $idComment = $comment['idComment'];

    $user = getUser($comment['idUser'])->fetch_assoc();
    $userName = $user['name'];
    $userSurName = $user['surname'];
    $userPhoto = $user['photo'];

    $reply = $link->query("SELECT * FROM comments WHERE idReplied = $idComment ;");
    $text = $comment['text'];
    $date = $comment['date'];

    ?>
    <div <?php if(!($isReply)){ ?> class="well" style="margin-bottom: 10px; overflow: hidden; border-radius: 8px;"<?php } ?>>

            <div class='col-md-12'>
                <div class='col-sm-8' <?php if($isReply){ ?> style="margin-left:50px; font-size: 12px; margin-bottom: -20px;"<?php } ?>>
                    <img class='img-circle <?php if($isReply){ ?>img-reply-user <?php }else{?>img-comment-user <?php } ?>    ' style="float: left;"height='65' width='65' src="<?php if ($userPhoto == null) {
                    echo " uploads/nophoto.png ";
                    } else {
                        echo $userPhoto;
                    }?>">
                
                    <p><?php echo $userName." ".$userSurName; ?> <small><?php echo $date;?></small></p>
                    <p><?php echo $text; ?></p>

                    <br>
                </div>
                <div class="col-sm-4">
                    <?php  
                    $link= connect();
                    $sql="select idUser from gauchadas where idGauchadas=$idGauchada;";
                    $query=$link->query($sql);
                    $row=mysqli_fetch_array($query);
                    $idUserGauchada=$row['idUser'];

                    $notMyComment= $user['idUsers'] != $idUserGauchada;
                    $notRepliedYet=($reply->num_rows == 0);
                
                    if (isset($_SESSION['idUsers']) and ($_SESSION['idUsers'] == $idUserGauchada) and $notRepliedYet and $notMyComment ){?>
                        <a href="" class="btn btn-default col-sm-4">Responder</a>
                    



                    <?php } ?>
                </div>
            </div> <!-- engloba a un comentario -->

           <?php 
           if ($reply->num_rows > 0) {?>
                    <p style="margin-left:30px; margin-bottom: 0px;"><span class='badge'>1</span> Respuesta para <?php echo  $userName ?>:</p><br>
                    <?php 
                    showComment($reply->fetch_assoc(),$idGauchada, true);
                    ?>
                <?php }
            ?>

    </div> <!-- container por cada par comentario-reply -->
    <?php
}
