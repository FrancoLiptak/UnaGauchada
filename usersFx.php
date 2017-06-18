<?php

    function getUser($idUser) {
        $link = connect();
		$query = "SELECT * FROM users WHERE idUsers = $idUser;";
        $result = $link->query($query);
        if (!$result) {
            printf("Errormessage: %s\n", $link->error);
            return false;
        }
		return $result;
	}

    function showUser($user) {?>
        
    <div class="container col-md-12 centered">
        <div class="page-header">
            <h2>
                <?php echo $user['name'],' ',$user['surname'] ; ?>
            </h2>
        </div>
        <div class="col-md-6">
            <img class="img-thumbnail img-detail" src="
                <?php
                if ($user['photo'] == null) {
                echo " uploads/63229-logoUnaGauchada.png ";
                } else {
                echo $user['photo'];
                }
                ?> 
                "> <br><br>
        </div>


    </div>

    <?php }
?>