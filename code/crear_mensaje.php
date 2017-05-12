<!DOCTYPE html>
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
        session_start();
        $usuario = $_SESSION['log'];
        include("funciones.php");
        $receptor = isset($_POST['receptor'])?$_POST['receptor']:null;
        if($receptor == null){
          $receptor = "Todos";
        }
        $asunto = isset($_POST['asunto'])?$_POST['asunto']:null;
        $mensaje = isset($_POST['mensaje'])?$_POST['mensaje']:null;

        if(comprobarReceptor($receptor)){
          echo 'Se inserta el mensaje';
          if(insertarMensajeBD($usuario, $receptor, $asunto, $mensaje)){
            header('Location: bandeja.php?enviado=bien'); //el correo se ha enviado correctamente 
          }
          else{
            header('Location: bandeja.php?enviado=mal'); //el correo no se ha enviado
          }
        }
        else{
          header('Location: bandeja.php?envio=fatal'); //el correo no se ha enviado porque no vale el receptor
        }
    ?>
  </body>
</html>