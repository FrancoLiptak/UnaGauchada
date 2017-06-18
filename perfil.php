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
?>

<html>
<head>
    <title>Perfil</title>
    <?php
        include("footer.html");
        getUser($_SESSION['idUsers']); //En una consulta traigo todos los datos
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
                    <img alt="User Pic" class="img-rounded img-responsive" src='<?php getPhoto(); ?>'>
                </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Nombre:</td>
                        <td>
                            <?php
                                getName();
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Apellido:</td>
                        <td>
                            <?php
                                getSurname();
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Reputación:</td>
                        <td>
                            <?php
                                getReputation();
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Créditos:</td>
                        <td>
                            <?php
                                getCredits();
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Fecha de nacimiento:</td>
                        <td>
                            <?php
                                getBirthDate();
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>Teléfono:</td>
                        <td>
                            <?php
                                getPhone();
                            ?>
                        </td>
                      </tr>
                      <tr>
                        <td>E-mail</td>
                        <td>
                            <?php
                                getEmail();
                            ?>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  
                </div>
              </div>
              <a class="btn btn-info" href=""><span class="glyphicon glyphicon-edit"></span> Editar Perfil</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

</body>
</html>
