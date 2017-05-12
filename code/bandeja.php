<!DOCTYPE html>
  <?php 
        include("funciones.php");
        session_start();
        if(!isset($_SESSION['log'])){
          header('Location: ../index.php?nologin=true');
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
                <li><a href="bandeja.php?tipo=recibidos">Recibidos<span class="badge">42</span><span class="sub_icon glyphicon glyphicon-envelope"></span></a></li>
                <li><a href="bandeja.php?tipo=enviados">Enviados<span class="badge">42</span><span class="sub_icon glyphicon glyphicon-send"></span></a></li>
                <li><a href="bandeja.php?tipo=eliminados">Eliminados<span class="sub_icon glyphicon glyphicon-trash"></span></a></li>
            </ul>
          <li><a>Tu perfil<span class="sub_icon glyphicon glyphicon-user"></span></a></li>
          <li><a href="salida.php">Salir<span class="sub_icon glyphicon glyphicon-off"></span></a></li>
        </ul>
      </div>

      
      
      <?php $tipoBandeja = isset($_GET['tipo'])?$_GET['tipo']:"recibidos"; ?>
      <!-- Page content -->
      <div id="page-content-wrapper">
        <!-- Keep all page content within the page-content inset div! -->
        <div class="page-content inset">
            <div class="row">
                <div <?php if(isset($_GET["envio"]) && $_GET["envio"]=="bien"){ ?> class="panel panel-success">
                    <div class="panel-heading respuesta">¡El correo se ha enviado!</div>
                    <?php }else if(isset($_GET["envio"]) && $_GET["envio"] == "mal"){ ?> class="panel panel-danger"> <div class = "panel-heading respuesta"> No se ha podido enviar el correo, si quiere puede <a href="contactar.php">contactar con el administrador </a></div><?php } else if(isset($_GET["envio"]) && $_GET["envio"]=="fatal"){ ?> class="panel panel-danger"> <div class="panel-heading respuesta">El receptor no era válido, por lo que no se envia el correo</div> <?php } else { ?> > <?php } ?>
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
                                      if($tipoBandeja == "recibidos"){
                                        echo "ENTRADA";
                                      }
                                      else if($tipoBandeja == "enviados"){
                                        echo "ENVIADOS";
                                      }
                                      else {
                                        echo "ELIMINADOS";
                                      } 
                                  ?>
                              </h3>
                          </div>
                          <div class="inbox-body">
                              <div class="mail-option">
                                <div class="chk-all">
                                    <input type="checkbox" class="mail-checkbox mail-group-checkbox">Todos
                                </div>

                                <div class="btn-group">
                                  <a
                                    <?php if($tipoBandeja == "enviados"){
                                      echo ' href = "bandeja.php?tipo=enviados"';
                                    }
                                    else{
                                      echo 'href= "bandeja.php"';
                                    }
                                    ?>
                                  type="button" class="btn mini"> <span class="glyphicon glyphicon-refresh"></span>Actualizar </a>
                                </div>
                              </div>
                              <table class="table table-inbox table-hover">
                                  <tbody>
                                      <tr>
                                        <td class="inbox-small-cells">Marcado</td>
                                        <td class="view-message  dont-show"> Emisor </td>
                                        <td class="view-message "> Asunto</td>
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

    <!--MANDAR UN CORREO -->
    <!-- MODAL PARA ESCRIBIR CORREO -->

    <div class="modal fade" id="crearMensaje" role="dialog">
        <div class="modal-dialog">
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
                                    <?php obtenerUsuarios(); ?>
                                </datalist>
                        <br>
                        <p>Asunto: </p>
                            <input type="text" class="form-control" placeholder="Asunto" name="asunto" aria-describedby="basic-addon2" required>
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
  </body>
  <script type="text/javascript">
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("active");
    });
  </script>



</html>