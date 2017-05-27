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
        else{
          $usuario = $_SESSION['log'];
        }
  ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    
    <meta name="description" content="Bandeja de entrada para MelomaMail">
    <meta name="author" content="Paloma Gutiérrez">
    <link rel="icon" href="../img/iconoNotaMusical.ico">

    <link href="../css/estiloMelomaMail.css" rel="stylesheet">
    <link href="../css/estiloBandeja.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower|League+Script" rel="stylesheet">

    <!--PARA LOS GLYPHICONS-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title> Administrador | MelomaMail </title>

  </head>

  <body>
    <div id="wrapper" class="active">  
    <!-- Sidebar -->
            <!-- Sidebar -->
      <div id="sidebar-wrapper">
        <ul id="sidebar_menu" class="sidebar-nav">
           <li class="sidebar-brand"><a id="menu-toggle" href="#">MelomaMail<span id="main_icon" class="glyphicon glyphicon-align-justify"></span></a></li>
        </ul>
        <ul class="sidebar-nav" id="sidebar">
            <li><a href="" onClick="$('#crearGrupo').modal()" data-toggle="modal">Crear grupo<span class="sub_icon"><img class="iconosNuevos" src="../img/crearGrupo.png"></span></a></li>
            <li><a href="mostrarGrupos.php">Ver grupos<span class="sub_icon"><img class="iconosNuevos" src="../img/verGrupo.png"></span></a></li>
            <li><a href="mostrarGrupos.php?accion=eliminar">Eliminar grupo<span class="sub_icon"><img class="iconosNuevos" src="../img/eliminarGrupo.png"></span></a></li>
            <li><a href="" onClick="$('#crearAdmin').modal()" data-toggle="modal">Crear admin<span class="sub_icon"><img class="iconosNuevos" src="../img/addAdministrador.png"></span></a></li>
            <li><a href="salida.php">Salir<span class="sub_icon glyphicon glyphicon-off"></span></a></li>
        </ul>
      </div>

      <!-- Page content -->
      <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
            <div class="row">
                <div <?php if(isset($_GET["cotilla"]) && $_GET["cotilla"]=='si'){ ?> class="panel panel-warning">
                  <div class="panel-heading respuesta">¿Está intentando mirar cosas que no le corresponden?</div>
                  <?php }else{ ?> >
                  <?php } ?>
                </div>
                <div <?php if(isset($_GET["creado"]) && $_GET["creado"]=='bien'){ ?> class="panel panel-success">
                  <div class="panel-heading respuesta">¡Se ha creado el admin correctamente!</div>
                  <?php }else{ ?> >
                  <?php } ?>
                </div>
                <div <?php if(isset($_GET["creado"]) && $_GET["creado"]=='mal'){ ?> class="panel panel-danger">
                  <div class="panel-heading respuesta">No se ha podido crear el admin</div>
                  <?php }else{ ?> >
                  <?php } ?>
                </div>
                <div <?php if(isset($_GET["creado"]) && $_GET["creado"]=='datosMal'){ ?> class="panel panel-danger">
                  <div class="panel-heading respuesta">Las contraseñas no coinciden</div>
                  <?php }else{ ?> >
                  <?php } ?>
              </div>
            <div class="row">
                <div class="col-md-12">
                  <p class="saludo well lead"><img class="icono" src="../img/iconoNotaMusical.ico"> Estás conectado como: <?php echo $usuario; ?></p>
                  <div class="mail-box">
                      <div class="lg-side">
                          <div class="inbox-head">
                              <h3>
                                  BIENVENIDO A LA ADMINISTRACIÓN DE GRUPOS DE MELOMAMAIL
                              </h3>
                          </div>
                          <div class="inbox-body">
                             <h3> Si quieres enviar correos, regístrate como un usuario sin privilegios. </h3>
                             <h3> Para hacer cualquier otra tarea puedes usar la barra de la izquierda </h3>
                          </div>
                      </div>
                  </div>
                </div>
            </div>
        </div>
      </div>
    </div> 

    <?php include("footer.html"); ?>

    <!--MANDAR UN CORREO -->
    <!-- MODAL PARA ESCRIBIR CORREO -->

    <div class="modal fade" id="crearGrupo" tabindex="1" role="dialog" aria-labelledy="myModalLabel">
        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4 class="modal-title text-center">Nuevo grupo</h4>
                     <br>
                </div>
                <div class="modal-body">
                    <form action="crear_grupo.php" method="post" id="nuevo_grupo" name="nuevo_grupo" onsubmit="return validarFormulario()"> 
                        <p> Tipo de música: </p>
                            <select class="input" name="tipoMusica" id="tipoMusica" required>
                                <option value="pop">Pop</option>
                                <option value="rock">Rock</option>
                                <option value="indie">Indie</option>
                                <option value="rap">Rap</option>
                                <option value="jazz">Jazz</option>
                            </select>
                        <br>
                        <p>Nombre del grupo (tiene que ser único): </p>
                            <input type="text" class="form-control" placeholder="Nombre del grupo" id="nombreGrupo" name="nombreGrupo" aria-describedby="basic-addon2" required>
                        <br>
                        <p> Edad mínima: </p>
                            <input type="number" id="edadMinima" name="edadMinima" min="1" max="100" required>
                        <br>
                        <p> Edad máxima: </p>
                            <input type="number" id="edadMaxima" name="edadMaxima" min="1" max="100" required>
                        <br>
                            <input type="submit" class="btn btn-default">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--CREAR UN ADMIN -->
    <!-- MODAL PARA CREAR UN ADMIN -->

    <div class="modal fade" id="crearAdmin" tabindex="1" role="dialog">
        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4 class="modal-title text-center">Nuevo admin</h4>
                </div>
                <div class="modal-body2">
                    <form class="form-signin" action="crear_admin.php" method="post" name="f1">
                        
                        <p class="textosRegistro"> Nombre del nuevo administrador: </p>
                        <div class="labelDatos">
                          <span class= "glyphicon glyphicon-user"></span>
                          <input class="input" type="text" name="admin" placeholder="Nombre de administrador" required>
                        </div>
                        <br>
                        <p class="textosRegistro"> Contraseña: </p>
                        <div class="labelDatos">
                          <span class="glyphicon glyphicon-lock"></span>
                          <input class="input" type="password" id="password1" name="password1" placeholder="Contraseña" required>
                        </div>
                        <br>
                        <p class="textosRegistro"> Repita la contraseña: </p>
                        <div class="labelDatos">
                          <span class="glyphicon glyphicon-lock"></span>
                          <input class="input" type="password" id="password2" name="password2" placeholder="Repita la contraseña" required>
                          <br>
                        </div>
                        <br>
                        <input class="btn btn-lg btn-warning btn-block" type="submit" value="Dar de alta" id="enviar">
                      </form>

                </div>
            </div>
        </div>
    </div>
  </body>
  <script type="text/javascript">
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("active");
    });
  </script>
  <script type="text/javascript">
    
    function validarFormulario() {
      //si meto 10 y 5 falla
      var edadMinima = document.getElementById("nuevo_grupo").elements.namedItem("edadMinima").value;

      var edadMaxima = document.getElementById("nuevo_grupo").elements.namedItem("edadMaxima").value;

      if (isNaN(edadMinima) || isNaN(edadMaxima)){
        alert("Hay que insertar números");
        return false;
      }
      else{
        if(edadMaxima < edadMinima) {
          alert("La edad mínima tiene que se más pequeña que la máxima");
          return false;
        }
      }

      return true;
    }
  </script>
</html>