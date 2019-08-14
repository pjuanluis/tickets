<?php	
	session_start();
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['title'])) {
           $errors[] = "Titulo vacío";
        } else if (empty($_POST['description'])){
			$errors[] = "Description vacío";
		} else if (
			!empty($_POST['title']) &&
			!empty($_POST['description'])
		){


		include "../config/config.php";//Contiene funcion que conecta a la base de datos

		$title = $_POST["title"];
		$description = $_POST["description"];
		$category_id = $_POST["category_id"];
		$project_id = $_POST["project_id"];
		$priority_id = $_POST["priority_id"];
		$user_id = $_SESSION["user_id"];
		$kind_id = $_POST["kind_id"];
		$created_at="NOW()";

		// $user_id=$_SESSION['user_id'];

		$sql="insert into ticket (title,description,category_id,project_id,priority_id,user_id,kind_id,created_at) value (\"$title\",\"$description\",\"$category_id\",\"$project_id\",$priority_id,$user_id,$kind_id,$created_at)";

		$query_new_insert = mysqli_query($con,$sql);
			if ($query_new_insert){
				$messages[] = "Tu ticket ha sido registrado satisfactoriamente.";
				$prioridad = '';

				if ($priority_id == 1) {
					$prioridad = 'Alta';
				}
				elseif ($project_id == 2) {
					$prioridad = 'Media';
				} else {
					$prioridad = 'Baja';
				}
				$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
				$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				$para = 'pjuanluis97@gmail.com';
				$asunto = 'Se ha creado un nuevo ticket con prioridad '.$prioridad;
				$nombre = $_SESSION['name'];
				$email = $_SESSION['email'];
				$mensaje = $description;
				$cuerpo = file_get_contents('mail_new.php');
				str_replace(".$descripcion.", $description, $cuerpo);
				str_replace(".$prioridad.", $prioridad, $cuerpo);
				mail($para, $asunto, $cuerpo, $cabeceras);

			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>