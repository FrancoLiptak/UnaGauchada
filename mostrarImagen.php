<?php   
// Se recibe el valor que identifica la imagen en la tabla de gauchadas. 
 $id = $_GET['idGauchada'];
 Include("conexion.php"); 
 $link=conectar();   
 
 // se recupera la información de la imagen
 $sql = "SELECT contenidoImagen, tipoImagen FROM productos WHERE idGauchada=$id";   
 $result = mysqli_query($link, $sql);
 $row = mysqli_fetch_array($result);   
 mysqli_close($link);   
 
 // se imprime la imagen y se le avisa al navegador que lo que se está  
 // enviando no es texto, sino que es una imagen de un tipo en particular  
 header("Content-type: ". $row['tipoImagen']);
 echo $row['contenidoImagen']; 
  
?>
