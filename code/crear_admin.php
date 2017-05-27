<!DOCTYPE html>
<html lang="en">
  <head>

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
    <meta charset="utf-8">
    
    <meta name="description" content="Pagina de registro para MelomaMail">
    <meta name="author" content="Paloma Gutiérrez">
    <link rel="icon" href="../img/iconoNotaMusical.ico">

    <link href="../css/estiloMelomaMail.css" rel="stylesheet">

    <!--PARA LOS GLYPHICONS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title> Registro | MelomaMail </title>

  </head>

  <body>
    <?php
      $admin = isset($_POST['admin'])?$_POST['admin']:null; //Si $_POST['admin'] tiene algo, iguala $usuario a eso; sino lo pone a null y dará error
      $passw = isset($_POST['password1'])?$_POST['password1']:null;
      $passw2 = isset($_POST['password2'])?$_POST['password2']:null;
      if($passw != null && $admin != null && $passw2 != null){
        //si tenemos una contraseña comprobamos que sea igual que password2
        if($passw == $passw2){ //si ambas son iguales comprobamos que la edades sea un numero
          //ahora tenemos todos en variables. vamos a introducirlos en la base de datos.
          $db = @mysqli_connect('localhost', 'root', '', 'melomamail'); ///PONER UN IF, SI NO SE PUEDE CONECTAR --> CONTACTAR CON ADMIN
          //consulta para insertar el usuario
          $sql = "INSERT INTO usuarios(nombre, password, administrador) VALUES ('$admin', '$passw', 1)"; 
          $consulta = mysqli_query($db, $sql);
          
          if($consulta != null){
            header('Location: bandejaAdmin.php?creado=bien');
          }
          else{
            header('Location: bandejaAdmin.php?creado=mal');//algun dato no es valido y no se ha podido dar de alta
          }
        }
        else{
          header('Location: register.php?creado=datosMal'); //las contraseñas no coinciden
        }
      }
      
      @mysqli_close($db);
    
    ?>
  </body>  
</html>
