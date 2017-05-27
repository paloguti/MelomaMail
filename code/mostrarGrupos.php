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
            <li><a href="crearAdmin.php">Crear admin<span class="sub_icon"><img class="iconosNuevos" src="../img/addAdministrador.png"></span></a></li>
            <li><a href="salida.php">Salir<span class="sub_icon glyphicon glyphicon-off"></span></a></li>
        </ul>
      </div>

      <!-- Page content -->
      <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
            <div class="row">
              <div <?php if(isset($_GET["error"]) && $_GET["error"]=='bien'){ ?> class="panel panel-success">
                  <div class="panel-heading respuesta">¡Se ha creado el grupo correctamente!</div>
                  <?php }else{ ?> >
                  <?php } ?>
              </div>
              <div <?php if(isset($_GET["error"]) && $_GET["error"]=='datos'){ ?> class="panel panel-danger">
                  <div class="panel-heading respuesta">No se ha creado el grupo porque el nombre ya está siendo usado o porque ya existe un grupo con ese mismo rango de edad para ese tipo de musica</div>
                  <?php }else{ ?> > 
                  <?php } ?>
              </div>
              <div <?php if(isset($_GET["error"]) && $_GET["error"]=='edad'){ ?> class="panel panel-danger">
                  <div class="panel-heading respuesta">No se ha creado el grupo porque la edad máxima es más pequeña que la mínima</div>
                  <?php }else{ ?> >
                  <?php } ?>
              </div>
              <div <?php if(isset($_GET["error"]) && $_GET["error"]=='base'){ ?> class="panel panel-danger">
                  <div class="panel-heading respuesta">Ha habido un error</div>
                  <?php }else{ ?> >
                  <?php } ?>
              </div>
              <div <?php if(isset($_GET["eliminado"]) && $_GET["eliminado"]=='bien'){ ?> class="panel panel-success">
                  <div class="panel-heading respuesta">Se ha eliminado el grupo correctamente</div>
                  <?php }else{ ?> >
                  <?php } ?>
              </div>
              <div <?php if(isset($_GET["eliminado"]) && $_GET["eliminado"]=='mal'){ ?> class="panel panel-danger">
                  <div class="panel-heading respuesta">No se ha podido eliminar el grupo</div>
                  <?php }else{ ?> >
                  <?php } ?>
              </div>
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
                              <?php
                                if(isset($_GET["accion"]) && $_GET["accion"]=='eliminar'){
                                  $accion = $_GET["accion"];
                                  echo " <h3> Está viendo los grupos existentes, para borrar uno pulse el botón del grupo que quiera";
                                }
                                else{
                                  echo "<h3> Está viendo los grupos existentes, para ver sus componentes pulse el botón del grupo que quiera </h3>";
                                  $accion = 'nada';
                                }
                              ?>
                              <br>
                              <?php cargarGrupos($accion); ?>
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

    <!--Mirar UN GRUPO -->
    <!-- MODAL PARA MIRAR GRUPO -->

    <div class="modal fade" id="verGrupo" tabindex="1" role="dialog">
        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4 class="modal-title text-center">Ver grupo</h4>
                </div>
                <div class="modal-body2">

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
    function mostrarGrupo(identificador){
        $.ajax({
        type: "POST",
        dataType: "html",
        url: "grupos.php",
        data: {"id": identificador},
        success: function(data, textStatus){
          $(".modal-body2").html(data);
        }
      }).done(function(msg){});
    }

  </script>

</html>