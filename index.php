<!DOCTYPE html>
<html lang="en">
    <head>

        <?php 
          session_start();
          if(isset($_SESSION['log'])){
            if(!isset($_SESSION['admin'])){
              header('Location: bandeja.php');
            }
            else if(isset($_SESSION['admin'])=='si'){
              header('Location: bandejaAdmin.php');
            }
          }
        ?>
        <meta charset="utf-8">
        
        <meta name="description" content="Pagina principal para MelomaMail">
        <meta name="author" content="Paloma Gutiérrez">
        <link rel="icon" href="img/iconoNotaMusical.ico">

        <link href="css/estiloMelomaMail.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower|League+Script" rel="stylesheet">

        <!--PARA LOS GLYPHICONS-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <title> Pag.Principal | MelomaMail </title>

    </head>

    <body>
        <div class="container">
            <div class="row">
                <div <?php if(isset($_GET["nologin"]) && $_GET["nologin"]=='true'){ ?> class="panel panel-warning">
                  <div class="panel-heading respuesta">Usted no ha iniciado ninguna sesión y no puede acceder a esa página</div>
                  <?php }else{ ?> >
                  <?php } ?>
                </div>
            </div>
            <h1 class="titulo"> MelomaMail </h1>
            <img src="img/iconoNotaMusical.ico" class="img-principal">
            <div class="enlaces">
                <a href="code/login.php"><button type="button" class="botonPrincipal">Iniciar sesión</button></a>
                <a href="code/register.php"><button type="button" class="botonPrincipal">Registrarse</button></a>
            </div>
        </div>
        <?php include("code/footer.html"); ?>
    </body>
</html>

