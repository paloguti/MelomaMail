<?php
	    
	function cargarBandeja($usuario, $tipo){
		
    	if($usuario != null && $tipo != null){ //Si los parámetros son válidos saca de la base de datos la bandeja tipo
            $db = @mysqli_connect('localhost', 'root', '', 'melomamail');
            if($tipo == 'enviados'){
            	$sql = "SELECT * FROM mensajes WHERE emisor like'$usuario'";
            }
            else if($tipo == 'recibidos'){
            	$sql = "SELECT * FROM mensajes WHERE receptor like '$usuario'";
            }
            $consulta = mysqli_query($db, $sql);
            if($consulta != null){
            	if(mysqli_num_rows($consulta) != 0){
		            $mensajes = mysqli_fetch_object($consulta);
		            while($mensajes){
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
		            	
		            	echo '<td class="inbox-small-cells">
		                        <input type="checkbox" class="mail-checkbox">
		                      </td>
		        	          <td class="view-message  dont-show">';
		                if($tipo='enviados'){
		                	echo $mensajes->receptor;
		                }
		                else{
		                	echo $mensajes->emisor;
		                }
		                echo '</td>
		                      <td class="view-message ">'.$mensajes->asunto.'</td>
		                      <td class="view-message  text-right">'.$mensajes->fecha. '</td>
		                    </tr>';
		                $mensajes = mysqli_fetch_object($consulta);
		            }
		        }
		        else{
		        	echo '<p class="well lead">No tienes mensajes </p>';
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
        	echo '<option value="Todos"';
            while($usuarios){
				echo '<option value="'. $usuarios->nombre. '">';
				$usuarios = mysqli_fetch_object($consulta);
            }

        }
        @mysqli_close($db);
    }

    function comprobarReceptor($receptor){
    	echo $receptor;
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
	        }
	        
        	@mysqli_close($db);
		}
        return false;
    }
    function insertarMensajeBD($emisor, $receptor, $asunto, $mensaje){
    	$db = @mysqli_connect('localhost', 'root', '', 'melomamail');
    	$sql = "SELECT id FROM mensajes";
    	$consulta = mysqli_query($db, $sql);
    	if($consulta != null){
    		$id = mysqli_num_rows($consulta) + 1;
    	}
    	else{
    		$id = 1;
    	}
    	$formato = 'l jS \of F Y h:i:s A';
    	$fecha = date($formato); //devuelve el timestamp
    	if($receptor == "Todos"){
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
    	}
    	else{

	    	$sql = "INSERT INTO mensajes(id, emisor, receptor, asunto, mensaje, fecha, leido) VALUES ('$id', '$emisor', '$receptor', '$asunto', '$mensaje', '$fecha', 0)"; 
	        $consulta = mysqli_query($db, $sql);
	            
	        if($consulta != null){
	            return true;
        	}
        }
        return false;
    }

?>