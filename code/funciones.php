<html>

<?php
	function correosSinLeer($usuario){
		$db = @mysqli_connect('localhost', 'root', '', 'melomamail');
		$sql = "SELECT COUNT(*) FROM mensajes WHERE receptor like '$usuario' AND leido = 0";
		$consulta = mysqli_query($db, $sql);
		$filas = mysqli_fetch_row($consulta);

		if($consulta != null){
			return $filas[0];
		}
	
		return null;
	}
	function genteEnUnGrupo($grupo){
		$db = @mysqli_connect('localhost', 'root', '', 'melomamail');
		$sql = "SELECT COUNT(*) FROM componentes WHERE idGrupo = '$grupo'";
		$consulta = mysqli_query($db, $sql);
		$filas = mysqli_fetch_row($consulta);

		if($consulta != null){
			return $filas[0];
		}

		return null;
	}
	function cargarTusGrupos($usuario){
		$db = @mysqli_connect('localhost', 'root', '', 'melomamail');
		$sql = "SELECT idGrupo FROM componentes WHERE usuario = '$usuario'";
		$consulta = mysqli_query($db, $sql);
		if($consulta != null){
			$idGrupos = mysqli_fetch_object($consulta);
			$contador = 0;
			while($idGrupos){
				$sql1 = "SELECT nombreGrupo FROM grupos WHERE id = '$idGrupos->idGrupo'";
				$consulta1 = mysqli_query($db, $sql1);
				//esta consulta siempre tiene que sacar el nombre del grupo
				$nombreGrupos = mysqli_fetch_object($consulta1); //aquí solo hay un resultado porque el id es único para cada grupo
				$numeroMiembros = genteEnUnGrupo($idGrupos->idGrupo);
				if($numeroMiembros == null){
					$numeroMiembros = 0;
				}
				if($contador%3 == 0){
					echo '</div>';
					echo '<div class="row">';
				}

				echo '<div class="col-md-4 col-sm-6">
                        <div class="card-style">
                        	<div class="media bordeado">
                                <div class="media-body">
                                    <h5 class="media-heading">' . $nombreGrupos->nombreGrupo . '</h5>
                                    <div class="members pull-left"><small>Numero de miembros:' . $numeroMiembros . '</small></div>
                                    <div class="btn btn-sm btn-danger pull-right btn-part" rol="button"';
            	echo 				' onClick="mostrarGrupo(';                              
            	echo 					"'" . $idGrupos->idGrupo . "')";
            	echo 					'" data-toggle="modal" data-target="#verGrupo">Ver grupo</div>';
            	echo 	  		'</div>
                        	</div>
                        </div>
                      </div>';
                $contador = $contador+1;
                $idGrupos = mysqli_fetch_object($consulta);
			}
		}
	}
	function cargarGrupos($accion){
		$db = @mysqli_connect('localhost', 'root', '', 'melomamail');
		$sql = "SELECT * FROM grupos";
		$consulta = mysqli_query($db, $sql);
		if($consulta != null){
			$grupos = mysqli_fetch_object($consulta);
			echo '<div class="row">';
			$contador = 0;
			while($grupos){
				$id = $grupos->id;
				$numeroMiembros = genteEnUnGrupo($id);
				if($numeroMiembros == null){
					$numeroMiembros = 0;
				}
				if($contador%3 == 0){
					echo '</div>';
					echo '<div class="row">';
				}
				
                echo '<div class="col-md-4 col-sm-6">
                        <div class="card-style">
                        	<div class="media bordeado">
                                <div class="media-body">
                                    <h5 class="media-heading">' . $grupos->nombreGrupo . '</h5>
                                    <div class="members pull-left"><small>Numero de miembros:' . $numeroMiembros . '</small></div>';
                if($accion = 'eliminar'){
                	echo 			'<a href="eliminarGrupo.php?grupo=' . $id . '" class="btn btn-sm btn-danger pull-right btn-part">Eliminar grupo </a>';
                }
                else{
                	echo 			'<div class="btn btn-sm btn-danger pull-right btn-part" rol="button"';
                	echo 			' onClick="mostrarGrupo(';                              
                	echo 					"'" . $id . "')";
                	echo 					'" data-toggle="modal" data-target="#verGrupo">Ver grupo</div>';
                }
                echo 	  		'</div>
                            </div>
                        </div>
                      </div>';
                $contador = $contador + 1;
                $grupos = mysqli_fetch_object($consulta);
            }
        }
	}
	function cargarBandeja($usuario, $tipo){
		
    	if($usuario != null && $tipo != null){ //Si los parámetros son válidos saca de la base de datos la bandeja tipo
            $db = @mysqli_connect('localhost', 'root', '', 'melomamail');
            switch($tipo){
                case "recibidos":
            		$sql = "SELECT * FROM mensajes WHERE receptor like '$usuario' ORDER BY fecha DESC";
                  	break;
                case "recDifundidos":
	                $sql = "SELECT * FROM mensajes WHERE receptor like '$usuario' AND emisor like 'Todos' ORDER BY fecha DESC";
	                break;
                case "recPersonales":
	                $sql = "SELECT * FROM mensajes WHERE receptor like '$usuario' AND emisor != 'Todos' ORDER BY fecha DESC";
	                break;
                case "enviados":
	                $sql = "SELECT * FROM mensajes WHERE emisor like '$usuario' ORDER BY fecha DESC";
	                break;
                case "envDifundidos":
	                $sql = "SELECT * FROM mensajes WHERE emisor like '$usuario' AND receptor like 'Todos' ORDER BY fecha DESC";
	                break;
                case "envPersonales":
	                $sql = "SELECT * FROM mensajes WHERE emisor like '$usuario' AND receptor != 'Todos' ORDER BY fecha DESC";
	                  break;
              } 
            $consulta = mysqli_query($db, $sql);
            if($consulta != null){
            	if(mysqli_num_rows($consulta) != 0){
		            $mensajes = mysqli_fetch_object($consulta);
		            while($mensajes){
		            	$id = $mensajes->id;
		            	
		            	if($tipo == "recibidos"){
		            		if($mensajes->leido == 0){
		            			echo '<tr class="unread">';
		            		}
		            		else {
		            			echo '<tr class="">';
		            		}
		            	}
		            	else {
		            		echo '<tr class="">';
		            	}
		            	
		            	echo '<td class="view-message  dont-show" rol="button" onClick="mostrarMensaje(';
		        	    echo "'". $id . "')"; 
		        	    echo '" data-toggle="modal" data-target="#leerMensaje">';
		                if($tipo =='enviados' || $tipo == 'envPersonales' || $tipo == 'envDifundidos'){
		                	echo $mensajes->receptor;
		                }
		                else{
		                	echo $mensajes->emisor;
		                }
		                echo '</td>
		                      <td class="view-message" rol="button" onClick="mostrarMensaje(';
		        	    echo "'". $id . "')"; 
		        	    echo '" data-toggle="modal" data-target="#leerMensaje">';
		        	    echo $mensajes->asunto.'</td>
		                      <td class="view-message  text-right" rol="button" onClick="mostrarMensaje(';
		        	    echo "'". $id . "')"; 
		        	    echo '" data-toggle="modal" data-target="#leerMensaje">';
		        	    echo $mensajes->fecha. '</td>
		                    </tr>';
		                $mensajes = mysqli_fetch_object($consulta);
		            }
		        }
		        else{
		        	echo '<p class="well lead">No tiene mensajes </p>';
		        }
		    }
	        @mysql_close($db);
      	}
	}

	function obtenerUsuarios(){
		$db = @mysqli_connect('localhost', 'root', '', 'melomamail');
		$sql = "SELECT nombre FROM usuarios";
		$consulta = mysqli_query($db, $sql);
        if($consulta != null){
        	$usuarios = mysqli_fetch_object($consulta);
        	echo '<option value="Todos">';
        	echo 'Difusión <br>';
            while($usuarios){
				echo '<option value="'. $usuarios->nombre. '">';
				echo "Usuario <br>";
				$usuarios = mysqli_fetch_object($consulta);
            }

        }
        @mysqli_close($db);
    }

    function obtenerGrupos($usuario){
    	$db = @mysqli_connect('localhost', 'root', '', 'melomamail');
    	$sql = "SELECT idGrupo FROM componentes WHERE usuario like '$usuario'";
    	$consulta = mysqli_query($db, $sql);
    	if($consulta != null){
    		$idGrupos = mysqli_fetch_object($consulta);
    		while($idGrupos){
    			$identificador = $idGrupos->idGrupo;
    			$sql1 = "SELECT nombreGrupo FROM grupos WHERE id = '$identificador'";
    			$consulta1 = mysqli_query($db, $sql1);
    			$nombreGrupos = mysqli_fetch_object($consulta1);
    			echo '<option value="' . $nombreGrupos->nombreGrupo . '">';
    			echo "Grupo";
    			$idGrupos = mysqli_fetch_object($consulta);
    		}
    	}
    }

    function validarGrupo($nombreGrupo, $edadMinima, $edadMaxima, $tipoMusica){
    	$db = @mysqli_connect('localhost', 'root', '', 'melomamail');
    	$sql = "SELECT nombreGrupo FROM grupos";
    	$consulta = mysqli_query($db, $sql);
    	if($consulta != null){
    		$grupos = mysqli_fetch_object($consulta);
    		while($grupos){
    			if($nombreGrupo == $grupos->nombreGrupo){
    				return false;
    			}
    			$grupos = mysqli_fetch_object($consulta);
    		}
    	}
    	$sql = "SELECT edadMinima, edadMaxima, tipoMusica FROM grupos";
    	$consulta = mysqli_query($db, $sql);
    	if($consulta != null){
    		$datos = mysqli_fetch_object($consulta);
    		while($datos){
    			if($edadMinima == $datos->edadMinima && $edadMaxima == $datos->edadMaxima && $tipoMusica == $datos->tipoMusica){
    				return false;
    			}
    			$datos = mysqli_fetch_object($consulta);
    		}
    	}
    	@mysqli_close($db);
    	return true;
    }

    function comprobarReceptor($receptor, $usuario){
    	if($receptor == "Todos"){
    		return true;
    	}
    	else {
    		$db = @mysqli_connect('localhost', 'root', '', 'melomamail');
			$sql = "SELECT nombre FROM usuarios";
			$consulta = mysqli_query($db, $sql);
	        if($consulta != null){
	        	$usuarios = mysqli_fetch_object($consulta);
	        	while($usuarios){
					if($receptor == $usuarios->nombre){
						return true;
					}
					$usuarios = mysqli_fetch_object($consulta);
	            }
	            $sql1 = "SELECT idGrupo FROM componentes WHERE usuario like '$usuario'";
	            $consulta1 = mysqli_query($db, $sql1);
	            if($consulta1 != null){
	            	$idGrupos = mysqli_fetch_row($consulta1);
	            	$idProbar = $idGrupos[0];
	            	echo $idProbar;
	            	$sql2 = "SELECT nombreGrupo FROM grupos WHERE id = '$idProbar'";
	            	$consulta2 = mysqli_query($db, $sql2);
	            	$nGrupos = mysqli_fetch_object($consulta2);
	            	while($nGrupos){
	            		if($receptor == $nGrupos->nombreGrupo){
	            			return true;
	            		}
	            		$nGrupos = mysqli_fetch_object($consulta2);
	            	}
	            }
	        }
	        
        	@mysqli_close($db);
		}
        return false;
    }

    function insertarGrupoBD($nombreGrupo, $edadMinima, $edadMaxima, $tipoMusica){
    	$db = @mysqli_connect('localhost', 'root', '', 'melomamail');

    	$sql = "INSERT INTO grupos (nombreGrupo, edadMinima, edadMaxima, tipoMusica) VALUES ('$nombreGrupo', '$edadMinima', '$edadMaxima', '$tipoMusica')"; 
    		$consulta = mysqli_query($db, $sql);
    		if($consulta != null){
    			return true;
    		}
    		return false;
    }

	function insertarMensajeBD($emisor, $receptor, $asunto, $mensaje){
    	$db = @mysqli_connect('localhost', 'root', '', 'melomamail');
    	    	 	
    	$formato = 'Y/m/d H:i:s';
    	$fecha = date($formato); //devuelve el timestamp
    	/*FUNCION PARA QUE CADA MENSAJE DEL DIFUNDIDO SEA DIFERENTE Y SE PUEDAN BORRAR
    	if($receptor == "Todos" || $receptor == "todos"){
    		$sql = "SELECT nombre FROM usuarios where nombre != '$emisor'";
    		$consulta = mysqli_query($db, $sql);
    		$usuarios = mysqli_fetch_object($consulta);
    		while($usuarios){
    			$receptor = $usuarios->nombre;
    			$sql1 = "INSERT INTO mensajes(id, emisor, receptor, asunto, mensaje, fecha, leido) VALUES ('$id', '$emisor', '$receptor', '$asunto', '$mensaje', '$fecha', 0)"; 
    			$consulta1 = mysqli_query($db, $sql1);
    			$id = $id + 1;
    			$usuarios = mysqli_fetch_object($consulta);
    		}
    		return true;
    	}*/
    	
    	if($receptor == "Todos"){

    		echo $asunto;
    		$sql = "INSERT INTO mensajes (emisor, receptor, asunto, mensaje, fecha, leido) VALUES ('$emisor', '$receptor', '$asunto', '$mensaje', '$fecha', 1)"; 
    		$consulta = mysqli_query($db, $sql);
    		if($consulta != null){
    			return true;
    		}
    	}
    	else{

	    	$sql = "INSERT INTO mensajes (emisor, receptor, asunto, mensaje, fecha, leido) VALUES ('$emisor', '$receptor', '$asunto', '$mensaje', '$fecha', 0)"; 
	        $consulta = mysqli_query($db, $sql);
	            
	        if($consulta != null){
	            return true;
        	}
        }
        return false;
    }

    function rellenarGrupo($nombreGrupo, $edadMinima, $edadMaxima, $tipoMusica){
    	echo "Rellenamos el grupo " . $nombreGrupo . "<br>";
    	$db = mysqli_connect('localhost', 'root', '', 'melomamail');
    	$sql = "SELECT * FROM usuarios where ((musica like '$tipoMusica') AND (edad >= '$edadMinima') AND (edad <= '$edadMaxima') AND (administrador = 0))";
    	$consulta = mysqli_query($db, $sql);
    	if($consulta != null){
    		$sql1 = "SELECT id FROM grupos WHERE nombreGrupo = '$nombreGrupo'";
    		echo $sql1;
    		$consulta1 = mysqli_query($db, $sql1);
    		$grupo = mysqli_fetch_row($consulta1);
    		$grupoId = $grupo[0];
    		echo "esto muestra: ". $grupoId;

    		$grupis = mysqli_fetch_object($consulta);
    		
    		while($grupis){
    			$usuario = $grupis->nombre;
    			$sql2 = "INSERT INTO componentes (idGrupo, usuario) VALUES ('$grupoId', '$usuario')";
    			$consulta2 = mysqli_query($db, $sql2);
    			$grupis = mysqli_fetch_object($consulta);
    		}
    	}
    	else {
    		echo "No se ha hecho la sql que busca los grupis";
    	}
    }

    function eliminarGrupo($idGrupo){
    	$db = @mysqli_connect('localhost', 'root', '', 'melomamail');
    	echo $idGrupo;
    	$sql = "DELETE FROM grupos WHERE id = '$idGrupo'";
    	$consulta = mysqli_query($db, $sql);
    	if($consulta != null){
    		return true;
    	}
    	return false;
    }

?>
</html>