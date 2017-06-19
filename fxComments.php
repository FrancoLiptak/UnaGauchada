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
                <div class="col-sm-4" style="float:right;">
                    <?php  
                    $link= connect();
                    $sql="select idUser from gauchadas where idGauchadas=$idGauchada;";
                    $query=$link->query($sql);
                    $row=mysqli_fetch_array($query);
                    $idUserGauchada=$row['idUser'];

                    $notMyComment= $user['idUsers'] != $idUserGauchada;
                    $notRepliedYet=($reply->num_rows == 0);
                
                        ?><div class="col-sm-6">
                     <?php if (isset($_SESSION['idUsers']) and ($_SESSION['idUsers'] == $idUserGauchada) and $notRepliedYet and $notMyComment ){?>
                            
                            <!-- <a href=""  id="submit" class="btn btn-info "><span class="glyphicon glyphicon-comment"></span> Reply </a> -->

                        <div style="margin-bottom: 50px;">
                            <a href="#" class="btn btn-info" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" onclick="style.display = 'none'; formReplyComment.style.display = 'block'">
                            Responder
                            </a>
                            
                            <form action="replyComment.php" method="post" style="display:none" id="formReplyComment">
                                    <div class="form-group col-md-12"> 
                                        <input type="text" name="idGauchadas" hidden value="<?php echo $gauchada['idGauchadas']; ?>">
                                        <textarea style="width:100%;"class="form-control" name="replyComment" placeholder="Responde a un comentario."></textarea>
                                        <input type="text" name="idUsers" value="<?php echo $_SESSION['idUsers'] ?>" hidden>
                                        <input type="text" name="idGauchadas" value="<?php echo $comment['idGauchada'] ?>" hidden>
                                        <input type="text" name="idComment" value="<?php echo $comment['idComment'] ?>" hidden>
                                        <button type="submit" class="btn btn-warning" style="<?php if(!($replyComment['replyComment'])) ?> margin-bottom: 20px;"><span class="glyphicon glyphicon-ok-circle"></span> Responder </button>
                                    </div>
                            </form>
                        </div>



                    <?php } ?>
                        </div>
                    <?php
                    if ( validateLogin() && ( isAdmin() || $_SESSION['idUsers'] == $idUserGauchada) ){
                        ?> 
                        <div class="col-sm-6" >
                            <a href="" id="submit"  class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Eliminar</a>
                        </div>
                    <?php }
                    ?>
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

function newComment($idUser, $idGauchada, $comment){
    if (validateUser($idUser) && validateGauchada($idGauchada) && validate($comment)) {
        $link = connect();
        $date = date('Y-m-d H:i:s');
        $query = "INSERT INTO comments (idUser, idGauchada, text, date)";
        $query = $query."VALUES ($idUser, $idGauchada, '$comment', '$date')";
        if ($result = $link->query($query)) {
            return $result;
        }
        $_SESSION['msg'] = $link->error;
        echo $_SESSION['msg'];
    }
    return false;
}

function deleteComment($idGauchada, $idUser, $idComment){ //LLAMAR EN SHOWCOMMENT
    if (validateGauchada($idGauchada) && validateUser($idUser) && validateComment($idComment)) {
        $link = connect();
        $query = "DELETE FROM comments WHERE idUsers=$idUser AND idGauchada=$idGauchada AND idComment = $idComment";
        $result = $link->query($query);
        return $result;
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
            return $result;
        }
        $_SESSION['msg'] = $link->error;
    }
    return false;
}
