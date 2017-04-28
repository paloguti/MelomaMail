<?php
			session_start();
			if(isset($_SESSION["autentificado"]) && $_SESSION["autentificado"] == "SI"){
				header('Location: /aw');
			}


?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Pag. de Login</title>
		<meta charset="utf-8">
		<link href="estilo.css" rel="stylesheet" type="text/css">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			var contra1OK = false;
			var contra2OK = false;
			var nombreOK = false;
			var usuOK = false;
			var emailOK = false;
		</script>

		

	</head>
	
	<body>
		<div id="bg"><img src="img/bg_login.jpg"></div>
		<div class="auxbloq3">
			<!--<img src="img/LogotipoFinal.png" alt="usuario" class="img-circle auximg1" width="80px" height="60px">-->
			<h1 id="informativoLogin">Regístrate en Turistea</h1>
			<div class="auxbloq4">
				<div id="menuLogin">
					<div <?php if(isset($_GET["errorusuario"]) && $_GET["errorusuario"]=="si"){ ?> class="panel panel-danger">
						    <div class="panel-heading">El nombre de usuario ya existe pruebe con otro.</div>
						    <?php }else{ ?> > 
							<?php } ?>
					</div>
					<div <?php if(isset($_GET["erroridentifi"]) && $_GET["erroridentifi"]=="si"){ ?> class="panel panel-danger">
						    <div class="panel-heading">No se han escrito correctamente los campos.</div>
						    <?php }else{ ?> > 
							<?php } ?>
					</div>
					<form action="sigin.php" method="POST">

						<div class="auxlabel1"><label class="etiquetas">Nombre:</label></div>
						<div>
							<div class="input-group auxbloq6">
							    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							    <input id="nombre" type="text" class="form-control" name="nombre" placeholder="Nombre de Usuario">
							   
							</div>
							<div class="auximg5">
								<img id="error_nombre" class="hidden" src="img/error.png" alt="Error" title="Error" width="20px" height="20px">
		                        <img id="ok_nombre" class="hidden" src="img/ok.png" alt="Ok" title="Ok" width="20px" height="20px">
		                    </div>
			            </div>
						<div class="auxlabel1"><label class="etiquetas">Usuario:</label></div>
						<div>
							<div class="input-group auxbloq6">
							    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
							    <input id="usuario" type="text" class="form-control" name="usuario" placeholder="Tu ID de Usuario">
							</div>
							<div class="auximg5">
								<img id="error_usu" class="hidden" src="img/error.png" alt="Error" title="Error" width="20px" height="20px">
		                        <img id="ok_usu" class="hidden" src="img/ok.png" alt="Ok" title="Ok" width="20px" height="20px">
		                    </div>
						</div>

						<div class="auxlabel1"><label class="etiquetas">Email:</label></div>
						<div>
							<div class="input-group auxbloq6">
							    <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
							    <input id="email" type="text" class="form-control" name="email" placeholder="Tu Correo electrónico">

							</div>
							<div class="auximg5">
								<img id="error_email" class="hidden" src="img/error.png" alt="Error" title="Error" width="20px" height="20px">
		                        <img id="ok_email" class="hidden" src="img/ok.png" alt="Ok" title="Ok" width="20px" height="20px">
		                    </div>
						</div>
						
						<div class="auxlabel1"><label class="etiquetas">Contraseña:</label></div>
						<div>
							<div class="input-group auxbloq6">
							    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
							    <input id="contra1" type="password" class="form-control" name="contra" placeholder="Mi Password">
							    
							</div>
							<div class="auximg5">
								<img id="error_cont1" class="hidden" src="img/error.png" alt="Error" title="Error" width="20px" height="20px">
		                        <img id="ok_cont1" class="hidden" src="img/ok.png" alt="Ok" title="Ok" width="20px" height="20px">
		                    </div>
						</div>

						<!--Aun falta por hacer la comprobación de las contraseñas en javasript-->

						<div class="auxlabel1"><label class="etiquetas">Introduzca de nuevo tu contraseña:</label></div>
						<div>
							<div class="input-group auxbloq6">
						    	<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
						    	<input id="contra2" type="password" class="form-control" name="contra2" placeholder="Mi Password">
							</div>
							<div class="auximg5">
								<img id="error_cont2" class="hidden" src="img/error.png" alt="Error" title="Error" width="20px" height="20px">
		                        <img id="ok_cont2" class="hidden" src="img/ok.png" alt="Ok" title="Ok" width="20px" height="20px">
		                    </div>
						</div>
			       		
			           
						<!--<div class="auxbloq1"><button type="button" onclick="preguntaValidar()">Enviar</button></div>-->
					   	<div class="hidden" id="botonEnviar"><div class="auxbloq1"> <input type="submit" id="buttonEnviar" value="Enviar"></div></div>

					</form>	
				</div>						
			</div>
		</div>
	</body>
	<script type="application/javascript">

		
	    document.getElementById('email').addEventListener("change", function () {
	    	expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	        if ( !expr.test(this.value)){
	            //alert("La dirección de correo " + this.value + " es incorrecta.");
	            document.getElementById('email').style.border = "1px solid red";
	            document.getElementById('error_email').setAttribute("class", "show");
	            document.getElementById('ok_email').setAttribute("class", "hidden");
	            this.focus();
	            emailOK = false;
	        }else{
	            document.getElementById('email').style.border = "1px solid green";
	            document.getElementById('ok_email').setAttribute("class", "show");
	            document.getElementById('error_email').setAttribute("class", "hidden");
	            emailOK = true;

	        }

	        if(emailOK && contra1OK && contra2OK && nombreOK && usuOK){
            	document.getElementById('botonEnviar').setAttribute("class", "show");
            }else{
            	document.getElementById('botonEnviar').setAttribute("class", "hidden");
            }

	    }, false);

	    document.getElementById('usuario').addEventListener("change", function () {
	     	var usuario = document.getElementById("usuario").value;
	     	var espacios = false;
			var cont = 0;
		     while (!espacios && (cont < usuario.length)) {
				 if (usuario.charAt(cont) == " ")
				    espacios = true;
				  cont++;
			 }
		 
			if (espacios || usuario.length == 0) {
			 // alert ("EL usuario no puede contener espacios en blanco");
			  document.getElementById('usuario').style.border = "1px solid red";
			  document.getElementById('ok_usu').setAttribute("class", "hidden");
	          document.getElementById('error_usu').setAttribute("class", "show");
			  usuOK = false;
			}
	        else{
	            document.getElementById('usuario').style.border = "1px solid green";
	            document.getElementById('ok_usu').setAttribute("class", "show");
	            document.getElementById('error_usu').setAttribute("class", "hidden");
	            usuOK = true;
	        }

	        if(emailOK && contra1OK && contra2OK && nombreOK && usuOK){
            	document.getElementById('botonEnviar').setAttribute("class", "show");
            }else{
            	document.getElementById('botonEnviar').setAttribute("class", "hidden");
            }

	    }, false);

	    document.getElementById('nombre').addEventListener("change", function () {
	     	var nombre = document.getElementById("nombre").value;
	     	var espacios = false;
			var cont = 0;
		     while (!espacios && (cont < nombre.length)) {
				 if (nombre.charAt(cont) == " ")
				    espacios = true;
				  cont++;
			 }
		 
			if (espacios || nombre.length == 0) {
			  
			  document.getElementById('nombre').style.border = "1px solid red";
			  document.getElementById('ok_nombre').setAttribute("class", "hidden");
	          document.getElementById('error_nombre').setAttribute("class", "show");
	          nombreOK = false;
			}
	        else{
	          	document.getElementById('nombre').style.border = "1px solid green";
	           	document.getElementById('ok_nombre').setAttribute("class", "show");
	            document.getElementById('error_nombre').setAttribute("class", "hidden");
	            nombreOK = true;
	        }

	        if(emailOK && contra1OK && contra2OK && nombreOK && usuOK){
            	document.getElementById('botonEnviar').setAttribute("class", "show");
            }else{
            	document.getElementById('botonEnviar').setAttribute("class", "hidden");
            }

	    }, false);

	     document.getElementById('contra1').addEventListener("change", function () {
			var p1 = document.getElementById("contra1").value;
			var p2 = document.getElementById("contra2").value;
	        if ( p1 != p2){
	           // alert("Las contraseñas no coinciden.");
	            
	            document.getElementById('contra2').style.border = "1px solid red";
	            
	            
	            document.getElementById('error_cont2').setAttribute("class", "show");
	            document.getElementById('ok_cont2').setAttribute("class", "hidden");
	            contra2OK = false;

	            
	        }else{

	          
	            document.getElementById('contra2').style.border = "1px solid green";

	            document.getElementById('ok_cont2').setAttribute("class", "show");
	            document.getElementById('error_cont2').setAttribute("class", "hidden");
	            contra2OK = true;
	        }

	        if(emailOK && contra1OK && contra2OK && nombreOK && usuOK){
            	document.getElementById('botonEnviar').setAttribute("class", "show");
            }else{
            	document.getElementById('botonEnviar').setAttribute("class", "hidden");
            }

	    }, false);
		
		document.getElementById('contra2').addEventListener("change", function () {
			var pp1 = document.getElementById("contra1").value;
			var pp2 = document.getElementById("contra2").value;
	        if ( pp1 != pp2){
	           // alert("Las contraseñas no coinciden.");
	            
	            document.getElementById('contra2').style.border = "1px solid red";
	            
	            
	            document.getElementById('error_cont2').setAttribute("class", "show");
	            document.getElementById('ok_cont2').setAttribute("class", "hidden");
	            contra2OK = false;
	            
	        }else{

	          
	            document.getElementById('contra2').style.border = "1px solid green";

	            document.getElementById('ok_cont2').setAttribute("class", "show");
	            document.getElementById('error_cont2').setAttribute("class", "hidden");
	             contra2OK = true;
	        }

	        if(emailOK && contra1OK && contra2OK && nombreOK && usuOK){
            	document.getElementById('botonEnviar').setAttribute("class", "show");
            }else{
            	document.getElementById('botonEnviar').setAttribute("class", "hidden");
            }

	    }, false);

	   


	     document.getElementById('contra1').addEventListener("change", function () {
	     	var p1 = document.getElementById("contra1").value;
	     	var espacios = false;
			var cont = 0;
		     while (!espacios && (cont < p1.length)) {
				 if (p1.charAt(cont) == " ")
				    espacios = true;
				  cont++;
			 }
		 
			if (espacios || p1.length == 0) {
			  
			  //alert ("La contraseña no puede contener espacios en blanco");
			  document.getElementById('contra1').style.border = "1px solid red";
			  document.getElementById('error_cont1').setAttribute("class", "show");
	          document.getElementById('ok_cont1').setAttribute("class", "hidden");
			  todoOK = false;
			   contra1OK = false;
			}
	        else{
	            document.getElementById('contra1').style.border = "1px solid green";
	            document.getElementById('ok_cont1').setAttribute("class", "show");
	            document.getElementById('error_cont1').setAttribute("class", "hidden");
	             contra1OK = true;
	        }

	        if(emailOK && contra1OK && contra2OK && nombreOK && usuOK){
            	document.getElementById('botonEnviar').setAttribute("class", "show");
            }else{
            	document.getElementById('botonEnviar').setAttribute("class", "hidden");
            }

	    }, false);

	     // Borde rojo y verde de usuario y nombre funciona mal y comprobarOK() tambien. Hay que cambiar los alert por testos!!!



	</script>
</html>