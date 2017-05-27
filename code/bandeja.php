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
          $correosSinLeer = correosSinLeer($usuario);
        }
    ?>

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

    <title> Bandeja de entrada | MelomaMail </title>

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
            <li><a href="" onClick="$('#crearMensaje').modal()" data-toggle="modal">Redactar correo<span class="sub_icon glyphicon glyphicon-pencil"></span></a></li>
            <ul class="sidebar-nav" id="sidebar">
                <li><a href="bandeja.php?tipo=recibidos">Recibidos<span class="badge-guay badge"> 
                    <?php 
                      if($correosSinLeer != null){
                        echo $correosSinLeer;
                      }
                    ?>
                    </span><span class="sub_icon glyphicon glyphicon-envelope"></span></a></li>
                <li><a href="bandeja.php?tipo=recPersonales"> > No difundidos</a></li>
                <li><a href="bandeja.php?tipo=recDifundidos">  > Difundidos</a></li>
                <li><a href="bandeja.php?tipo=enviados">Enviados<span class="sub_icon glyphicon glyphicon-send"></span></a></li>
                <li><a href="bandeja.php?tipo=envPersonales">  > No difundidos</a></li>
                <li><a href="bandeja.php?tipo=envDifundidos">  > Difundidos</a></li>
            </ul>
          <li><a href="tusGrupos.php">Tus grupos<span class="sub_icon glyphicon glyphicon-user"></span></a></li>
          <li><a href="salida.php">Salir<span class="sub_icon glyphicon glyphicon-off"></span></a></li>
        </ul>
      </div>

      
      
      <?php $tipoBandeja = isset($_GET['tipo'])?$_GET['tipo']:"recibidos"; ?>
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
              <div <?php if(isset($_GET["envio"]) && $_GET["envio"]=='bien'){ ?> class="panel panel-success">
                  <div class="panel-heading respuesta">¡El correo se ha enviado bien!</div>
                  <?php }else{ ?> > 
                  <?php } ?>
              </div>
              <div <?php if(isset($_GET["envio"]) && $_GET["envio"]=='mal'){ ?> class="panel panel-danger">
                  <div class="panel-heading respuesta"> No se ha podidio enviar el correo si quiere puede <a href="contactar.php"> contactar con el administrador </a></div>
                  <?php }else{ ?> > 
                  <?php } ?>
              </div>
              <div <?php if(isset($_GET["envio"]) && $_GET["envio"]=='fatal'){ ?> class="panel panel-danger">
                  <div class="panel-heading respuesta"> El receptor no es válido, por lo que no se manda el correo (revise el destinatario)</div>
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
                                  BANDEJA DE
                                  <?php 
                                      switch($tipoBandeja){
                                        case "recibidos":
                                          echo "ENTRADA";
                                          break;
                                        case "recDifundidos":
                                          echo "ENTRADA DE MENSAJES DIFUNDIDOS";
                                          break;
                                        case "recPersonales":
                                          echo "ENTRADA DE MENSAJES PERSONALES";
                                          break;
                                        case "enviados":
                                          echo "ENVIADOS";
                                          break;
                                        case "envDifundidos":
                                          echo "ENVIADOS DE MENSAJES DIFUNDIDOS";
                                          break;
                                        case "envPersonales":
                                          echo "ENVIADOS DE MENSAJES PERSONALES";
                                          break;
                                        default: 
                                          echo "ELIMINADOS";
                                      } 
                                  ?>
                              </h3>
                          </div>
                          <div class="inbox-body">
                              <div class="mail-option">
                                <div class="btn-group">
                                  <a
                                    <?php 
                                      switch($tipoBandeja){
                                        case "recibidos":
                                          echo ' href = "bandeja.php"';
                                          break;
                                        case "recDifundidos":
                                          echo ' href = "bandeja.php?tipo=recDifundidos"';
                                          break;
                                        case "recPersonales":
                                          echo ' href = "bandeja.php?tipo=recPersonales"';
                                          break;
                                        case "enviados":
                                          echo ' href = "bandeja.php?tipo=enviados"';
                                          break;
                                        case "envDifundidos":
                                          echo ' href = "bandeja.php?tipo=envDifundidos"';
                                          break;
                                        case "envPersonales":
                                          echo ' href = "bandeja.php?tipo=envPersonales"';
                                          break;
                                        default: 
                                          echo ' href = "bandeja.php?tipo=cualquiercosa"';
                                      } 
                                    ?>
                                  type="button" class="btn mini"> <span class="glyphicon glyphicon-refresh"></span>Actualizar </a>
                                </div>
                              </div>
                              <table class="table table-inbox table-hover">
                                  <tbody>
                                      <tr class="color">
                                        <?php if($tipoBandeja == "enviados" || $tipoBandeja == "envDifundidos" || $tipoBandeja == "envPersonales"){
                                          echo '<td class="view-message dont-show"> Receptor </td>';
                                        }
                                        else {
                                          echo '<td class="view-message  dont-show"> Emisor </td>';
                                        } ?>
                                        <td class="view-message"> Asunto</td>
                                        <td class="view-message  text-right">Fecha</td>
                                      </tr>
                                      <?php cargarBandeja($usuario, $tipoBandeja); ?>
                                      
                                  </tbody>
                              </table>
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

    <div class="modal fade" id="crearMensaje" tabindex="1" role="dialog" aria-labelledy="myModalLabel">
        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">X</button>
                    <h4 class="modal-title text-center">Nuevo correo</h4>
                     <br>
                    <p class="comentario"> Si no escribe nada en el campo destinatario, por defecto se enviará un difundido. </p>
                    <p class="comentario"> También puede mandar un difundidio poniendo como destinatario Todos. </p>
                    <p class="comentario"> Si escribe un usuario en destinatario, y este no existe en la lista desplegable facilitada no se enviará el correo. </p>
                </div>
                <div class="modal-body">
                    <form action="crear_mensaje.php" method="post" id="nuevo_mensaje">
                        <p> Para: </p>
                            <input list="usuarios" id="receptor" name="receptor" class="form-control" placeholder="Usuario del destinatario" aria-describedby="basic-addon2">
                                <datalist id="usuarios">
                                    <?php obtenerUsuarios();
                                          obtenerGrupos($usuario);
                                    ?>
                                </datalist>
                        <br>
                        <p>Asunto: </p>
                            <input type="text" class="form-control" placeholder="Asunto" id="asunto" name="asunto" aria-describedby="basic-addon2" required>
                        <br>
                        <p> Mensaje: </p>
                            <textarea required class="form-control" name="mensaje" rows="3" placeholder="Escriba aquí su mensaje"></textarea>
                        <br>
                        
                        <input type="submit" class="btn btn-default">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Leer UN CORREO -->
    <!-- MODAL PARA leer CORREO -->

    <div class="modal fade" id="leerMensaje" tabindex="1" role="dialog">
        <div class="modal-dialog" role="document">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" onclick="actualizarVentana()">X</button>
                    <h4 class="modal-title text-center">Lectura de correo</h4>
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
    function mostrarMensaje(identificador){
      $.ajax({

        type: "POST",
        dataType: "html",
        url: "mensajes.php",
        data: {"id": identificador},
        success: function(data, textStatus){
          $(".modal-body2").html(data);
        }
      }).done(function(msg){});
    }

    function actualizarVentana(){
      location.reload();
    }
  </script>

</html>