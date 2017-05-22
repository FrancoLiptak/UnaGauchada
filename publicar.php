<html>
	<head>
	<title>Publicar gauchada</title>
  <?php Include("header.php"); ?>
<br>
<br>
  	<div class="row">
  			<?php 
         Include("alert.php");
        if(isset($_SESSION['mal_tamaño'])){
          hacerAlert("No se ha podido publicar su gauchada ya que la foto elegida excede los 65.536Bytes.");
          unset($_SESSION['mal_tamaño']);
        }
				if(isset($_SESSION['mal_completado'])){
           hacerAlert("No se ha podido publicar su gauchada ya que no se han completado todos los campos.");
           unset($_SESSION['mal_completado']);
        } 
        /* no se para q era...
        Include("connect.php"); 
        $link=connect();
        $email=$_SESSION['email'];
        $idUs= mysqli_query($link, "SELECT * FROM usuarios WHERE email='$email'");
        $US = mysqli_fetch_array($idUs); */
  			?>
        <br>
  			<form enctype="multipart/form-data" class="col-md-2 col-md-offset-5" action="procesarPublicar.php" method="post" target="_self" accept-charset="UTF-8" autocomplete="off" name="publicar_form" onsubmit="return validateFormPublicar()">
            <input type="text" name="nombreProd" class="diferenteInput" placeholder=" Titulo ...">
            <br><br>
            <label class="fake_place_holder"> Categoría...</label> &nbsp;<select class="styled-select" name="cat">
                 <?php
                $categorias=mysqli_query($link, "SELECT * FROM categorias_productos");
                Include ("hacerOption.php");
                while ($filaCat = mysqli_fetch_array($categorias)){
                mostrarCat($filaCat);
                }
                mysqli_close($link);
                ?>
            </select>
            <br><br>   <!-- con width 210 queda todo alineado -->
            <span class="row center-block span_area_texto"> 
               <textarea name="desc" class="form-control area_texto" rows="8" placeholder=" Descripción ..." ></textarea>
            </span>
            <br><br>
            <span class="center-block span_choose_f">
              <input type="file"  name="img" class="filestyle col-md-2 choose_f" data-input="true" data-size="md" data-buttonName="btn btn-danger" data-placeholder="Img..." ><br><p style="color:red; font-size:10px; font-family:'Montserrat', sans-serif;">Nota: el tamaño del archivo debe ser menor a 65,536 Bytes ó 8,2045 KB.</p>      
            </span>
            <br>
            <input type="number" name="precio" class="diferenteInput" placeholder=" Precio...">
            <br><br><br>
            <label class="fake_place_holder"> Fecha de caducidad..</label>&nbsp;&nbsp;
            <input type="date" class="caducidad" name="caducidad" step="1" min="2016-01-01" max="2019-12-31" "<?php echo date("Y-m-d");?>" >
            <input type="hidden" name="id" value="<?php echo  $US['idUsuario'] ?>">
            <br><br><br>
      			&nbsp;<input type="submit" name="submit" class="btn btn-warning" value="Publicar gauchada">
			</form>
			<br><br><br>
  		

  	</div> <!-- fin row -->
 

   <!-------------------------------------------- Script para validar el publicar -->
  <script rel="text/javascript" src="js/publicar.js"></script>

  <?php Include("footer.html"); ?>
 </body>
</html>
