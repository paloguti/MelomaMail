<!DOCTYPE html>
<html lang="en">
  <head>

    <?php 
      include("funciones.php");
      session_start();
      if(isset($_SESSION['log'])){
        if(!isset($_SESSION['admin'])){
          header('Location: bandeja.php?cotilla=si');
        }
        else if(isset($_SESSION['admin'])=='si'){
          header('Location: bandejaAdmin.php?cotilla=si');
        }
      }
    ?>
    <meta charset="utf-8">
    
    <meta name="description" content="Pagina de login para MelomaMail">
    <meta name="author" content="Paloma Gutiérrez">
    <link rel="icon" href="../img/iconoNotaMusical.ico">

    <link href="../css/estiloMelomaMail.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|League+Script" rel="stylesheet">

    <!--PARA LOS GLYPHICONS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title> Login | MelomaMail </title>

  </head>

  <body>
    <div class="container">
      <div class="contenido">
        <div class="row">
          <div <?php if(isset($_GET["errorusuario"]) && $_GET["errorusuario"]=="noexiste"){ ?> class="panel panel-danger">
                <div class="panel-heading respuesta">No existe ningún usuario dado de alta con ese nombre, o la contraseña no coincide.</div>
                <?php }else{ ?> > 
              <?php } ?>
          </div>
        </div>
        <div class="row">
          <div class="salida"> <a href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span></a></div>
          <form class="form-signin" action="comprobar_login.php" method="post">
            <div class="form-signin-heading">
              <img class="icono" src="../img/iconoNotaMusical.ico" alt="logo"> 
              <h2> Iniciar sesión</h2>
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input type="text" class="form-control" name="user" placeholder="Usuario" required autofocus>
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
            </div>

            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me"> Recordarme
              </label>
            </div>
            <input class="btn btn-lg btn-warning btn-block" type="submit" value="Entrar">
          </form>
        </div>
      </div>
    </div> <!-- /container -->
  </body>
</html>
