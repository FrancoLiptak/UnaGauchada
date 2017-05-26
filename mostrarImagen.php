<?php   
// Se recibe el valor que identifica la imagen en la tabla de gauchadas. 
 $id = $_GET['idGauchadas'];
 include_once "connect.php"; 
 $link=connect();   
 
 // se recupera la información de la imagen
 $sql = "SELECT image FROM gauchadas WHERE idGauchadas=$id";   
 $result = mysqli_query($link, $sql);
 $row = mysqli_fetch_array($result);   
 mysqli_error($link);
 die;
 mysqli_close($link);   
 
 // se imprime la imagen y se le avisa al navegador que lo que se está  
 // enviando no es texto, sino que es una imagen de un tipo en particular  
 echo $row['image']; 
  
?>
