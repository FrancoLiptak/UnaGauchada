<?php 
include_once 'validate.php';
if (!(validate($_SESSION['idUsers']))){
                $_SESSION['msg'] = "No estas logueado! No podes acceder a ver perfil.";
                header('Location: index.php');
                die;
            }
include_once "header.php";
include_once 'usersFx.php';
include_once 'alert.php';
include_once 'fxLogros.php';
?>

<html>
<head>
    <title>Perfil</title>
    <?php
        include("footer.html");
        $user = mysqli_fetch_array(getUser($_SESSION['idUsers']));
    ?>
</head>

<body>


<div class="perfil">
    <div class="container-fluid">
      <div class="row">
        <div class="container-fluid  col-md-6 col-md-offset-3 " >
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title">Información personal</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> 
                    <img alt="User Pic" class="img-rounded img-responsive" src='<?php echo $user['photo']; ?>'>
                </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Nombre:</td>
                        <td>
                            <?php
                                echo $user['name'];
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Apellido:</td>
                        <td>
                            <?php
                                echo $user['surname'];
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Reputación:</td>
                        <td>
                            <?php
                                echo logroConRep($user);
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Créditos:</td>
                        <td>
                            <?php
                               echo $user['credits'];
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Fecha de nacimiento:</td>
                        <td><small>
                            <?php
                               echo $user['birthDate'];
                            ?>
                            </small>
                        </td>
                      </tr>
                      <tr>
                        <td>Teléfono:</td>
                        <td>
                            <?php
                            if ($user['phone'] == null)
                              echo "---";
                            else
                                echo $user['phone'];
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>E-mail</td>
                        <td>
                            <?php
                                echo $user['email'];
                            ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <a class="btn btn-success" href=""><span class="glyphicon glyphicon-edit"></span> Editar Perfil</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

</body>
</html>
