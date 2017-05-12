<!DOCTYPE html>
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

    <title> Pagina Principal | MelomaMail </title>

  </head>

  <body>
    <div class="container">
      <div class="contenido">
        <div class="row">
          <div class="salida"> <a href="../index.php"><span class="glyphicon glyphicon-arrow-left"></span></a></div>
          <form class="form-signin" action="comprobar_login.php" method="post">
            <div class="form-signin-heading">
              <img class="icono" src="../img/iconoNotaMusical.ico" alt="logo"> 
              <h2> Iniciar sesión</h2>
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
              <input type="text" class="form-control" name="user" placeholder="Usuario" required>
            </div>
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="password" class="form-control" name="password" placeholder="Contraseña" required>
            </div>

            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me"> Recordarme
              </label>
            </div>
            <input class="btn btn-lg btn-warning btn-block" type="submit" value="Entrar">
          </form>
        </div>
      </div>
    </div> <!-- /container -->
  </body>
</html>

	<body>
		
		<?php
			session_start();
			$_SESSION['usuario'];
			echo $_SESSION['usuario'];
			$db = @mysqli_connect('localhost', 'root', '', 'libreria');
			$sql = "SELECT DISTINCT Categoria FROM libros";
			$consulta = mysqli_query($db, $sql);
			if($consulta != null){
				echo "<form name='formulario1' method='post' action='pedido2.php' >";
					echo "Elija la categoría: <br>";
					echo "<select name='cat'>";
					echo "Hola";
					while($lista=mysqli_fetch_object($consulta)){
						echo "<option value=".$lista->Categoria.">" .$lista->Categoria. " </option>";
					}
					echo "</select>";
					echo "<input type='submit' value='Enviar'>";
				echo "</form>";
			}
			else{
				echo "No te sale";
			}
			?>
			
	</body>
</html>

