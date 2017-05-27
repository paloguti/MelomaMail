<!DOCTYPE HTML>
<html>
	<head>
		<?php
		  	include("funciones.php");
	        session_start();
	        if(!isset($_SESSION['log'])){
	          header('Location: ../index.php?nologin=true');
	        }
	        else if(isset($_SESSION['admin'])){
	          header('Location: bandejaAdmin.php?cotilla=si');
	        }
    	?>
		<title> Mostrar mensaje </title>
	</head>
	<body>
		
		<?php
			if(($identificador = filter_input(INPUT_POST, "id", FILTER_UNSAFE_RAW)) !== null){ //si se ha enviado el data "identificador"
				$db = mysqli_connect('localhost', 'root', '', 'melomamail');
				if(!$db){
					exit("Error de conexion.");
				}
				$sql = "SELECT * FROM mensajes WHERE id = '$identificador'";
				$consulta = mysqli_query($db, $sql);
				if($consulta != null){
					$mensaje = mysqli_fetch_object($consulta);
					echo '<p> De: '. $mensaje->emisor . '</p>';
					echo '<p> Asunto: ' . $mensaje->asunto . '</p>';
					echo '<p> Mensaje: </p>';
					echo $mensaje->mensaje . '<br>';
					$sql = "UPDATE mensajes SET leido = 1 WHERE id = '$identificador'";
					$consulta = mysqli_query($db, $sql);
				}
				@mysqli_close($db);
			}
			else {
				header('Location: bandeja.php?cotilla=si');
			}
		?>
	</body>
</html>