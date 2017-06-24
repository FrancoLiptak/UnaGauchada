<?php
    include_once 'connect.php';
    include_once 'validate.php';
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

function showComment($comment, $idGauchada, $numComment, $isReply = false)
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

            <div class='col-md-12' style="margin-bottom: -20px;" <?php if($isReply){ ?>  "background-color: #f8f5f5;" <?php } ?>>
                <div class='col-sm-8' <?php if($isReply){ ?> style=" font-size: 12px; margin-bottom: -20px;"<?php } ?>>
                    <img class='img-circle <?php if($isReply){ ?>img-reply-user <?php }else{?>img-comment-user <?php } ?>    ' style="float: left;"height='65' width='65' src="<?php if ($userPhoto == null) {
                    echo " uploads/nophoto.png ";
                    } else {
                        echo $userPhoto;
                    }?>">
                
                    <p><?php echo $userName." ".$userSurName; ?> <small><?php echo $date;?></small></p>
                    <p><?php echo $text; ?></p>

                    <br>
                </div>
                <div class="col-md-4" style="float: right; margin-right: 0px; padding-right: 0px;" >
                    <?php  
                    $link= connect();
                    $sql="select idUser from gauchadas where idGauchadas=$idGauchada;";
                    $query=$link->query($sql);
                    $row=mysqli_fetch_array($query);
                    $idUserGauchada=$row['idUser'];

                    $notMyComment= $user['idUsers'] != $idUserGauchada;
                    $notRepliedYet=($reply->num_rows == 0);
                
                    ?>  <div class="col-md-6"> <!-- este div siempre esta ocupando el lugar para mantener el diseño. Despues su boton interno puede mostrarse o no-->
                             <?php if (isset($_SESSION['idUsers']) and ($_SESSION['idUsers'] == $idUserGauchada) and $notRepliedYet and $notMyComment ){?>

                                    <a href="#!" class="btn btn-info" onclick="style.display = 'none'; formReplyComment[<?php echo $numComment ?>].style.display = 'block'">Responder</a>

                            <?php } ?>
                        </div>
                    <?php
                    if ( validateLogin() && ( isAdmin() || $_SESSION['idUsers'] == $idUserGauchada || $_SESSION['idUsers'] == $comment['idUser']) ){
                        ?> 
                        <div class="col—md—6" >
                            <a href="" class="btn btn-danger" style="padding-right: 18px; padding-left: 18px;" onclick=""> <span class="glyphicon glyphicon-trash"></span> Eliminar </a>
                        </div>
                    <?php }
                    ?>
                </div> <!-- del responder y eliminar-->
                <div class="col-md-12">
                    <br>
                    <?php
                    if (!$isReply) {
                    ?>
                    <form action="replyComment.php" method="post" style="display:none;" id="formReplyComment">
                                    <div class="form-group col-md-9"> 
                                        <input type="text" name="idGauchadas" hidden value="<?php echo $comment['idGauchadas']; ?>">
                                        <textarea style="width:100%;"class="form-control" name="replyComment" placeholder="Responde a <?php echo  $userName ?>." required></textarea>
                                        <input type="text" name="idUsers" value="<?php echo $_SESSION['idUsers'] ?>" hidden>
                                        <input type="text" name="idGauchadas" value="<?php echo $comment['idGauchada'] ?>" hidden>
                                        <input type="text" name="idComment" value="<?php echo $comment['idComment'] ?>" hidden>
                                    </div>
                                    <button type="submit" class="btn btn-info col-md-3" id="submit" style="<?php if(!($replyComment['replyComment'])) ?> ;margin-bottom: 20px; float: right; width:14%;"> Responder </button>
                            </form>
                    <?php
                    }
                    ?>
                </div> <!-- engloba a un form de respuesta -->
            
            </div> <!-- engloba a un comentario -->

           <?php 
           if ($reply->num_rows > 0) {?>
                    <p style="margin-left:30px; margin-bottom: 0px; margin-top: 85px;"><span class='badge'>1</span> Respuesta para <?php echo  $userName ?>:</p><br>
                    <?php 
                    showComment($reply->fetch_assoc(),$idGauchada, 0, true);
                    ?>
                <?php }
            ?>

    </div> <!-- container por cada par comentario-reply -->
    <?php
}


function newComment($idUser, $idGauchada, $comment){
    if (validateUser($idUser) && validateGauchada($idGauchada) && validate($comment)) {
        $link = connect();
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO comments (idUser, idGauchada, text, date)";
        $query = $query."VALUES ($idUser, $idGauchada, '$comment', '$date')";
        if ($result = $link->query($query)) {
            $_SESSION['msg'] = "Comentaste exitosamente.";
            return $result;
        }
        $_SESSION['msg'] = $link->error;
    }
    return false;
}

function deleteComment($idGauchada, $idUser, $idComment){ //LLAMAR EN SHOWCOMMENT
    if (validateGauchada($idGauchada) && validateUser($idUser) && validateComment($idComment)) {
        $link = connect();
        $query = "DELETE FROM comments WHERE idUsers=$idUser AND idGauchada=$idGauchada AND idComment = $idComment";
        if ($result = $link->query($query)) {
            $_SESSION['msg'] = "El comentario fue eliminado.";
            return $result;
        }
        $_SESSION['msg'] = $link->error;
    }
    return false;
}

function replyComment($idGauchada, $idUser, $idComment, $reply){
   if (validateUser($idUser) && validateGauchada($idGauchada) && !validateComment($idComment) && validate($reply)) {
        $link = connect();
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO comments (idUser, idGauchada, idReplied, text, date)";
        $query = $query."VALUES ($idUser, $idGauchada, $idComment, '$reply', '$date')";
        if ($result = $link->query($query)) {
            $_SESSION['msg'] = "Respondiste exitosamente.";
            return $result;
        }
        $_SESSION['msg'] = $link->error;
    }
    return false;
}


?>
