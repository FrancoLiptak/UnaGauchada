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
    $query = "SELECT * FROM comments WHERE idGauchada = $idGauchada;";
    $result = $link->query($query);
    if (!$result) {
        printf("Errormessage: %s\n", $link->error);
        return false;
    }
    return $result;
}

function showComment($comment)
{
    $link = connect();
    $idComment = $comment['idComment'];

    $user = getUser($comment['idUser'])->fetch_assoc();
    $userName = $user['name'];
    $userPhoto = $user['photo'];

    $reply = $link->query("SELECT * FROM comments WHERE idReplied = $idComment ;");
    $text = $comment['text'];
    $date = $comment['date'];

    ?>
    <div class="container" >

        <img src="<?php if ($userPhoto == null) {
            echo " uploads/nophoto.png ";
        } else {
            echo $userPhoto;
        }?>">
        <?php
        echo $userName;
        echo $date;
        echo $text;
        if ($reply->num_rows > 0) {
            showComment($reply->fetch_assoc());
        }
    ?>
    </div>
    <?php
}
