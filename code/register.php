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
    
    <meta name="description" content="Pagina de registro para MelomaMail">
    <meta name="author" content="Paloma Gutiérrez">
    <link rel="icon" href="../img/iconoNotaMusical.ico">

    <link href="../css/estiloMelomaMail.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <!--PARA LOS GLYPHICONS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title> Registro | MelomaMail </title>

  </head>

  <body>
    <div class="container">
      <div class="contenido">
        <div class="row">
          <div <?php if(isset($_GET["errorRegistro"]) && $_GET["errorRegistro"]=="datosMal"){ ?> class="panel panel-danger">
              <div class="panel-heading respuesta">Debe corregir los datos que están mal. Vuelva a introducir todos los datos. Si encuentra un cuadro rojo, antes de enviar el formulario corrijalos</div>
              <?php }else{ ?> > 
              <?php } ?>
          </div>
          <div <?php if(isset($_GET["errorRegistro"]) && $_GET["errorRegistro"]=="noalta"){ ?> class="panel panel-danger">
              <div class="panel-heading respuesta">Ese usuario ya está siendo usado, intentelo de nuevo</div>
              <?php }else{ ?> > 
              <?php } ?>
          </div>
        </div>
        <div class="row">
          <div class="salida"> <a href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span></a></div>
          <form class="form-signin" action="comprobar_registro.php" method="post" name="f1">
            <div class="form-signin-heading">
              <img class="icono" src="../img/iconoNotaMusical.ico" alt="logo"> 
              <h2> Registro para MelomaMail</h2>
            </div>

            <p class="textosRegistro"> Nombre de usuario: </p>
            <div class="labelDatos">
              <span class= "glyphicon glyphicon-user"></span>
              <input class="input" type="text" name="user" placeholder="Usuario" required>
            </div>

            <p class="textosRegistro"> Contraseña: </p>
            <div class="labelDatos">
              <span class="glyphicon glyphicon-lock"></span>
              <input class="input" type="password" id="password1" name="password1" placeholder="Contraseña" required>
            </div>

            <p class="textosRegistro"> Repita la contraseña: </p>
            <div class="labelDatos">
              <span class="glyphicon glyphicon-lock"></span>
              <input class="input" type="password" id="password2" name="password2" placeholder="Repita la contraseña" required>
            </div>
            
            <p class="textosRegistro"> Qué tipo de música le gusta*: </p> 
            <div class="labelDatos">
              <span class="glyphicon glyphicon-music"></span>
              <select class="input" name="tipoMusica" id="tipoMusica">
                <option value="pop">Pop</option>
                <option value="rock">Rock</option>
                <option value="indie">Indie</option>
                <option value="rap">Rap</option>
                <option value="jazz">Jazz</option>
              </select>
            </div>

            <p class="textosRegistro"> ¿Cuántos años tienes?** </p>
            <div class="labelDatos">
              <span class="glyphicon glyphicon-hourglass"></span>
              <input class="input" type="text" id="edad" name="edad" placeholder="Tu edad" required>
              <p id=oculto class="anotaciones"> Tienen que ser números!! </p>
            </div>
            <hr>
            <input class="btn btn-lg btn-warning btn-block" type="submit" value="Registrarme" id="enviar">

            <p class="anotaciones"> *Elija su favorito únicamente </p>
            <p class="anotaciones"> **Unicamente se utilizará tu edad para colocarte en un rango y poder mantener correspondencia con gente de tu edad </p>
          </form>
        </div>
      </div>
    </div>
  </body>

  <script type="text/javascript">
      //Cuando el elemento password2 cambia se realiza la fucion, también necesitamos el de la password1

        document.getElementById('password2').addEventListener("change", function() {
          
          clave1 = document.f1.password1.value; 
          clave2 = document.f1.password2.value; 

          if (clave1 == clave2) {
            this.style.border="2px solid green";
            document.getElementById('password1').style.border="2px solid green";
            return
          }    
            
          this.style.border="2px solid red";
          document.getElementById('password1').style.border="2px solid red";
          
      }, false);

      document.getElementById('edad').addEventListener("change", function(){
        //la funcion isNaN devuleve false cuando el argumento es un numero
        if(!isNaN(document.f1.edad.value)){
          //numero correcto
          this.style.border="2px solid green";
          document.getElementById('oculto').style.display="none";
          return;
        }
        //no es un numero
        this.style.border="2px solid red";
        document.getElementById('oculto').style.display="inline";
            
      }, false);

     
    </script>
</html>
