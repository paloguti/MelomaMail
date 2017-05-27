<!DOCTYPE html>
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

    <title> Crear grupo | MelomaMail </title>
  </head>

  <body>
    <?php  
        
        $tipoMusica = $_POST['tipoMusica'];
        $edadMinima =$_POST['edadMinima'];
        $edadMaxima = $_POST['edadMaxima'];
        $nombreGrupo = $_POST['nombreGrupo'];

        if($tipoMusica != null && $edadMinima != null && $edadMaxima != null && $nombreGrupo != null){
            if($edadMinima > $edadMaxima){
              echo "Las edades no son correctas";
              header('Location: mostrarGrupos.php?error=edades');
            }
            else if(!validarGrupo($nombreGrupo, $edadMinima, $edadMaxima, $tipoMusica)){
              echo "Ya existe un grupo con el mismo nombre o el mismo rango de edad con en el mismo tipo de musica";
              header('Location: mostrarGrupos.php?error=datos');
            }
            else{
              if(insertarGrupoBD($nombreGrupo, $edadMinima, $edadMaxima, $tipoMusica)){
                echo "El grupo está insertado";
                echo "Voy a rellenar el grupo";
                rellenarGrupo($nombreGrupo, $edadMinima, $edadMaxima, $tipoMusica);
                header('Location: mostrarGrupos.php?error=bien'); //el correo está insertado
              }
              else {
                echo "Ha habido un error";
                header('Location: mostrarGrupos.php?error=base');
              }
            }      
        } 
    ?>
  </body>
</html>