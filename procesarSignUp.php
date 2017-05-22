<?php 
Include("newUser.php"); 
session_start();

	   		$name=$_POST['name'];
			$surname=$_POST['surname'];
			$birthDate=$_POST['birthDate'];
			$email=$_POST['email'];
			$phone=$_POST['phone'];
			$pass1=$_POST['pass1'];
			$pass2=$_POST['pass2'];
           
			if (	!newUser($email, $pass1, $name, $surname, $birthDate, $phone)	){
			    
		    
		    //hacer que si no inserto porque ya hay otro mail igual, te avise 'Poné otro mail!!!'.
		       /* $emailDB= mysqli_query($link, "SELECT * FROM usuarios WHERE email='$email'");
				$row = mysqli_fetch_array($emailDB);
				$total_registros = mysqli_num_rows($row);
				echo "NO entra en newUser";
			    die;
				if ($total_registros == NULL )
					$_SESSION['otro_email']= 'mal';
				else 
					$_SESSION['no_registrado']= 'mal';
			    
			    header("Location: signUp.php");*/
			    echo "eror no entra a new user";
			    die;
		        }

?>
