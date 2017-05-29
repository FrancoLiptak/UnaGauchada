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

function showComment($comment, $isReply = false)
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
    <div class="container">

            <div class='col-md-12'>
                <div class='<?php if($isReply){ ?>col-xs-10 <?php }else{?> col-sm-10 <?php } ?>'>
                    <img class='img-circle <?php if($isReply){ ?>img-reply-user <?php }else{?>img-comment-user <?php } ?>    ' style="float: left;"height='65' width='65' src="<?php if ($userPhoto == null) {
                    echo " uploads/nophoto.png ";
                    } else {
                        echo $userPhoto;
                    }?>">
                
                    <h5><?php echo $userName." ".$userSurName; ?> <small><?php echo $date;?></small></h5>
                    <p><?php echo $text; ?></p>
                    <br>
                </div>
            </div> <!-- engloba a un comentario -->

           <?php 
           if ($reply->num_rows > 0) {?>
                    <p style="margin-left:30px;"><span class='badge'>1</span> Respuesta para <?php echo  $userName ?>:</p><br>
                    <?php 
                    showComment($reply->fetch_assoc(), true);
                    ?>
        
                <?php }
            ?>
    </div> <!-- container por cada par comentario-reply -->
    <?php
}
