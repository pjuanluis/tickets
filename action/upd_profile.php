<?php

	//update profile by abisoft https://github.com/amnersaucedososa
	session_start();

	if (!isset($_SESSION['user_id']) && $_SESSION['user_id']==null) {
		header("location: ../");
	}

	include "../config/config.php";


	$id = $_SESSION['user_id'];
	$status=0;
	if(isset($_POST['status'])){$status=1;}

	$name = $_POST['name'];
	$email = $_POST['email'];


	if(isset($_POST['token'])){
		$update=mysqli_query($con,"UPDATE user set name=\"$name\",email=\"$email\" where id=$id");
		if ($update) {
			$success=sha1(md5("datos actualizados"));
	   	}else{
	   		$error=sha1(md5("Error al actualizar los datos"));
            header("location: ../dashboard.php?error=$error");
	   	}

	   	// CHANGE PASSWORD
		if($_POST['password']!=""){

			$password = sha1(md5($_POST['password']));
			$new_password = sha1(md5($_POST['new_password']));
			$confirm_new_password = sha1(md5($_POST['confirm_new_password']));	

			if($_POST['new_password'] == $_POST['confirm_new_password']){

				$sql = mysqli_query($con,"SELECT * from user where id=$id");
				while ($row = mysqli_fetch_array($sql)) {
			    	$p = $row['password'];
				}

				if ($p==$password){ //comprobamos que la contraseña sea igual ala anterior
					$query = 
					$update_passwd=mysqli_query($con,"UPDATE user SET password=\"$new_password\" WHERE id = $id");
					if ($update_passwd) {
						$success_pass=sha1(md5("contrasena actualizada"));
            			header("location: ../dashboard.php?success_pass=$success_pass");
					}
				}else{
					$invalid=sha1(md5("la contrasena no coincide con la anterior"));
            		header("location: ../dashboard.php?invalid=$invalid");
				}
			}else{
				$error=sha1(md5("las nuevas contrasenas no coinciden"));
            	header("location: ../dashboard.php?error=$error");
			}
		} else {
			header("location: ../dashboard.php?success=$success");
		}
	}else{
		header("location: ../");
	}

?>
