<!DOCTYPE HTML>
<html>
	<?php 
        include("funciones.php");
        session_start();
        if(!isset($_SESSION['log'])){
          header('Location: ../index.php?nologin=true');
        }
        else if(!isset($_SESSION['admin'])){
          header('Location: bandeja.php?cotilla=si');
        }
  	?>
	<head>
		<title> Mostrar grupo </title>
	</head>
	<body>
		
		<?php
			if(($identificador = filter_input(INPUT_POST, "id", FILTER_UNSAFE_RAW)) !== null){ //si se ha enviado el data "identificador"
				$db = mysqli_connect('localhost', 'root', '', 'melomamail');
				if(!$db){
					exit("Error de conexion.");
				}
				$sql = "SELECT * FROM grupos WHERE id = '$identificador'";
				$consulta = mysqli_query($db, $sql);
				if($consulta != null){
					$grupo = mysqli_fetch_object($consulta);
					echo '<h3> Características del grupo: </h3>';
					echo '<p> Tipo de música: ' . $grupo->tipoMusica . '</p><br>';
					echo '<p> Rango de edades: Desde los ' . $grupo->edadMinima . ' hasta los ' . $grupo->edadMaxima . '</p><hr>';

					$sql = "SELECT * FROM componentes WHERE idGrupo = '$identificador'";
					$consulta = mysqli_query($db, $sql);
					if($consulta != null){
						$numero = mysqli_num_rows($consulta);
						echo '<h3> Componentes del grupo: </h3>';
						if($numero == 0){
							echo "<p> En este grupo aún no hay nadie </p>";
						}
						else {
							$gente = mysqli_fetch_object($consulta);
							echo '<ul>';
							while($gente){
								echo '<li>' . $gente->usuario . '</li>';
								$gente = mysqli_fetch_object($consulta);
							}
						}
					}
				}
				
				@mysqli_close($db);
			}
		?>
	</body>
</html>