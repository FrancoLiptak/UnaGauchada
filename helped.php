<html>

<head>
    <?php
        session_start();
        include_once 'validate.php';
        include_once 'fxHelp.php';
        include_once 'gauchadasFx.php';

        if (!validateLogin()) {
            $_SESSION['msg'] = "No estas logueado! No podes acceder a ver las gauchadas en las que ayudaste.";
            header('Location: index.php');
            die;
        }
        ?>
</head>

<body>
    <?php
        $idUser = $_SESSION['idUsers'];

        $AllHelps = getUserHelp($idUser);

        $accepted = array();
        $rejected = array();
        $pending = array();

        while ($help = $AllHelps->fetch_assoc()) {
            if ($hasAccepted = hasAccepted($help['idGauchada'])) {
                if ($hasAccepted = $idUser) {
                    $accepted[] = $help;
                } else {
                    $rejected[] = $help;
                }
            } else {
                $pending[] = $help;
            }
        }

    ?>
    <p>Aceptadas:
    </p>
    <?php
        foreach ($accepted as $i => $value) {
            $gauchada = getOneGauchada($accepted[$i]['idGauchada']);
            ?>
            <p>Gauchada:
                <?php echo $gauchada['title']; ?>
            </p>
            <p>Imagen Gauchada: <img src=<?php echo '"'.$gauchada[ 'image']. '"'; ?>></p>
            <p>Descripcion:
                <?php echo $gauchada['description']; ?>
            </p>
            <?php
        }
    ?>
    <p>Rechazadas:
    </p>
    <?php
        foreach ($rejected as $i => $value) {
            $gauchada = getOneGauchada($rejected[$i]['idGauchada']);
            ?>
            <p>Gauchada:
                <?php echo $gauchada['title']; ?>
            </p>
            <p>Imagen Gauchada: <img src=<?php echo '"'.$gauchada[ 'image']. '"'; ?>></p>
            <p>Descripcion:
                <?php echo $gauchada['description']; ?>
            </p>
            <?php
        }
    ?>
    <p>Pendientes:
    </p>
    <?php
        foreach ($pending as $i => $value) {
            $gauchada = getOneGauchada($pending[$i]['idGauchada']);
            ?>
            <p>Gauchada:
                <?php echo $gauchada['title']; ?>
            </p>
            <p>Imagen Gauchada: <img src=<?php echo '"'.$gauchada[ 'image']. '"'; ?>></p>
            <p>Descripcion:
                <?php echo $gauchada['description']; ?>
            </p>
            <?php
        }
    ?>
</body>

</html>