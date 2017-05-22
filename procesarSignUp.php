<?php 
Include("newUser.php"); 
session_start();
if(isset($_POST['submit'])){
	if ( ($_POST['name']=='') or ($_POST['surname']=='')  or ($_POST['birthDate']=='') or ($_POST['email']=='') or ($_POST['phone']=='')or ($_POST['pass1']=='')or ($_POST['pass2']=='')
	or($_POST['name']==' ') or ($_POST['surname']==' ') or ($_POST['email']==' ') or ($_POST['phone']==' ')or ($_POST['pass1']==' ')or ($_POST['pass2']==' ')
	or ($_POST['pass1'] != $_POST['pass2']) ){           
			    $_SESSION['mal_completado']= 'mal';
			    header("Location: signUp.php");
	}
	else {
	   		$name=$_POST['name'];
			$surname=$_POST['surname'];
			$birthDate=$_POST['birthDate'];
			$email=$_POST['email'];
			$phone=$_POST['phone'];
			$pass1=$_POST['pass1'];
			$pass2=$_POST['pass2'];
            
			if (	newUser($email, $pass1, $name, $surname, $birthDate, $phone);	){
			    $_SESSION['registrado']=$email.'/'.$pass1;
			    header("Location: signUp.php");
		    }
		    else{ //hacer que si no inserto porque ya hay otro mail igual, te avise 'Poné otro mail!!!'.
		        $emailDB= mysqli_query($link, "SELECT * FROM usuarios WHERE email='$email'");
				$row = mysqli_fetch_array($emailDB);
				$total_registros = mysqli_num_rows($row);
				if ($total_registros == NULL )
					$_SESSION['otro_email']= 'mal';
				else 
					$_SESSION['no_registrado']= 'mal';
			    
			    header("Location: signUp.php");
		        }
	    }
}
?>
