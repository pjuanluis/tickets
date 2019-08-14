<?php
	session_start();
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        } else if (empty($_POST['title'])){
			$errors[] = "Titulo vacío";
		} else if (empty($_POST['description'])){
			$errors[] = "Description vacío";
		} else if (!empty($_POST['title']) && !empty($_POST['description'])){

		include "../config/config.php";//Contiene funcion que conecta a la base de datos



		$title = $_POST["title"];
		$description = $_POST["description"];
		$category_id = $_POST["category_id"];
		$project_id = $_POST["project_id"];
		$priority_id = $_POST["priority_id"];
		$user_id = $_SESSION["user_id"];
		$status_id = 1;
		$kind_id = $_POST["kind_id"];
		$id=$_POST['mod_id'];

		if ($_SESSION["kind"] != 2) {
			$status_id = $_POST["status_id"];
		}


		$sql = "update ticket set title=\"$title\",category_id=\"$category_id\",project_id=\"$project_id\",priority_id=\"$priority_id\",description=\"$description\",status_id=\"$status_id\",kind_id=\"$kind_id\",updated_at=NOW() where id=$id";

		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "El ticket ha sido actualizado satisfactoriamente.";

				if ($_SESSION["kind"] != 2) {
					$estatus = '';

					if ($status_id == 1) {
						$estatus = 'Pendiente';
					} elseif ($status_id == 2) {
						$estatus = 'En desarrollo';
					} elseif ($status_id == 2) {
						$estatus = 'Terminado';
					} else {
						$estatus = 'Cancelado';
					}
					$usuario = mysqli_query($con, "select user_id from ticket where id = ".$id);
					$user = mysqli_fetch_array($usuario);
					$para = mysqli_query($con, "select email from user where id = ".$user['user_id']);
					$to = mysqli_fetch_array($para);
					$asunto = 'Se ha actualizado el estatus de su ticket';
					$cuerpo = 'Se ha actualizado el estatus de su ticket a <strong>'.$estatus.'</strong>';
					//mail($to, $asunto, $cuerpo, "");
					
				} else {
					$prioridad = '';

					if ($priority_id == 1) {
						$prioridad = 'Alta';
					}
					elseif ($project_id == 2) {
						$prioridad = 'Media';
					} else {
						$prioridad = 'Baja';
					}	

					$para = 'pjuanluis97@gmail.com';
					$asunto = 'Se ha actualizado un ticket';
					$nombre = $_SESSION['name'];
					$email = $_SESSION['email'];
					$mensaje = $description;
					$cuerpo = "Enviado por: ".$nombre."\n"."Email: ".$email."\n"."Descripción del problema: "."\n".$mensaje."\n"."Prioridad: ".$prioridad;
					
					//mail($para, $asunto, $cuerpo, "");
				}




			} else{
				$errors []= "Lo sentimos algo ha salido mal, intenta nuevamente.".mysqli_error($con);
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