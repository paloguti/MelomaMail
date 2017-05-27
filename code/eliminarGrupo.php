<!DOCTYPE HTML>

<?php 
	include("funciones.php");
	session_start();
	if(!isset($_SESSION['log'])){
		header('Location: ../index.php?nologin=true');
	}
	else if(!isset($_SESSION['admin'])){
		header('Location: bandeja.php?cotilla=si');
	}
	else {
		$usuario = $_SESSION['log'];
	}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
    
	    <meta name="description" content="Pagina de login para MelomaMail">
	    <meta name="author" content="Paloma Gutiérrez">
	    <link rel="icon" href="../img/iconoNotaMusical.ico">

	    <link href="../css/estiloMelomaMail.css" rel="stylesheet">

	    <!--PARA LOS GLYPHICONS-->
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	    <title> Crear mensaje | MelomaMail </title>

	</head>
	<body>
		<?php
			if(isset($_GET['grupo'])){
				$idGrupo = $_GET['grupo'];
				if(eliminarGrupo($idGrupo)){
					header('Location: mostrarGrupos.php?accion=eliminar&eliminado=bien');
				}
				else{
					header('Location: mostrarGrupos.php?accion=eliminar&eliminado=mal');
				}
			}
			else {
				header('Location: mostrarGrupos.php?acion=eliminar');
			}