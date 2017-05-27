<!DOCTYPE html>
<html lang="en">
  <head>

    <?php 
        include("funciones.php");
        session_start();
        if(!isset($_SESSION['log'])){
          header('Location: ../index.php?nologin=true');
        }
        else if(isset($_SESSION['admin'])){
          if($_SESSION['admin'] == "si"){
            header('Location: bandejaAdmin.php?cotilla=si');
          }
        }
        else{
          $usuario = $_SESSION['log'];
        }
    ?>
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
        $receptor = isset($_POST['receptor'])?$_POST['receptor']:null;
        echo $receptor;
        if($receptor == null){
          $receptor = "Todos";
        }
        
        $asunto = isset($_POST['asunto'])?$_POST['asunto']:null;
        $mensaje = isset($_POST['mensaje'])?$_POST['mensaje']:null;
        
        $receptorTrimmed = trim ( $receptor , " \t\n" );

        if($mensaje != null){

          if(comprobarReceptor($receptor, $usuario)){
            echo 'Se inserta el mensaje';
            echo "El receptor es válido";
            if(insertarMensajeBD($usuario, $receptorTrimmed, $asunto, $mensaje)){
              echo "Se ha insertado ";
              header('Location: bandeja.php?enviado=bien'); //el correo se ha enviado correctamente 
            }
            else{
              echo "No se ha insertado";
              header('Location: bandeja.php?enviado=mal'); //el correo no se ha enviado
            }
          }
          else{
            echo "El receptor es inválido (no funciona la de comprobarReceptor";
            header('Location: bandeja.php?envio=fatal'); //el correo no se ha enviado porque no vale el receptor
          }
        }
        else{
          header('Location : bandeja.php?cotilla=si');
        }
    ?>
  </body>
</html>