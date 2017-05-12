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

    <title> Login | MelomaMail </title>

  </head>

  <body>
    <?php
      $usuario = isset($_POST['user'])?$_POST['user']:null; //Si $_POST['user'] tiene algo, iguala $usuario a eso; sino lo pone a null y dará error
      $pasw= isset($_POST['password'])?$_POST['password']:null; //Si teiene algo iguala, sino a null
      if($pasw!= null AND $usuario != null){ //Si ambos datos han sido introducidos, vamos a buscarlos en la base de datos
        $db = @mysqli_connect('localhost', 'root', '', 'melomamail');
        $sql = "SELECT password FROM usuarios where nombre='$usuario'";
        $consulta = mysqli_query($db, $sql);
        if($consulta != null){
          $contrasenia = mysqli_fetch_object($consulta);
          if($contrasenia->password == $pasw){
              session_start();
              $_SESSION['log'] = $usuario;
              header('Location: bandeja.php');
          }
          else{
            header('Location: login.php?errorusuario=noexiste');//echo "El usuario no existe o la contraseña está mal puesta"; //La contraseña está mal puesta
          }
        }
        else{
          header('Location: login.php?errorusuario=noexiste');//echo "El usuario no existe o la contraseña está mal puesta"; //EL usuario no existe
        }
        @mysqli_close($db);
      }
    ?>
  </body>
</html>