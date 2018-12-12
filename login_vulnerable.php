<?php
session_start();
$server = "localhost";
$dbname = "informacion";
$username = "root";
$password = "";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sitio Bancario</title>
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<?php
	if(isset($_SESSION["user"])){
		echo("<h3>Hola " .$_SESSION["user"]."</h3>");
		echo('<a href="process_vulnerable.php?action=logout">Cerrar sesion</a>');
		?>
		<br><br>
		<h3>Saldo actual: </h3>
		
<?php
		$mysqli = new mysqli($server, $username, $password, $dbname);
		// Check connection
		if ($mysqli->connect_errno) {
		    printf("Falló la conexión: %s\n", $mysqli->connect_error);
		    exit();
		}

		if ($resultado = $mysqli->query("SELECT Usuario,cantidad FROM usuarios")) {
		    while($row = $resultado->fetch_assoc()) {
		    	if($_SESSION["user"] == $row['Usuario']){
		    		echo("<h4> $ " .$row['cantidad']."</h4>");
		    		break;
		    	}
		        //echo($row['Usuario']." ".$row['cantidad']);
		    }
		    /* liberar el conjunto de resultados */
		    $resultado->close();
		}
?>



		<br><br>

<div class="container">
			<center>
				<div id="miformulario">
				<h3>Transferir dinero</h3>
		<form action="process_vulnerable.php?action=transfer" method="post">
			
			<input placeholder="Destinatario" class="form-control" type="text" name="destinatary"><br>
			<input placeholder="Cantidad ($)" class="form-control" type="number" name="quantity"><br>
			<input class="btn btn-success" type="submit" value="Procesar" name="">
			<br><br>
		</form>
			</div>
			</center>
		</div>


		<!--<label>Transferir dinero</label>
		<form action="process_vulnerable.php?action=transfer" method="post">
			<input type="text" name="destinatary"><br><br>
			<input type="number" name="quantity"><br><br>
			<input type="submit" value="Procesar" name="">
			<br><br>
		</form>-->
		<?php 
	}
	else{
		?>
<div class="container">
			
			<center>
				<h1>Bienvenido a su sitio bancario</h1>
				<div id="miformulario">
				
		<form action="process_vulnerable.php?action=login" method="post">
			<!-- admin test-->
			<!-- usuario comun-->
			<input class="form-control" type="text" name="user" placeholder="Usuario"><br>
			<input class="form-control" type="password" name="pass" placeholder="Contraseña"><br>
			<input class="btn btn-success" type="submit" value="Iniciar sesion">
			
		</form>
			</div>
			</center>
		</div>
			<footer class="footer">
				<p>Mi sitio bancario 2018</p>
			</footer>




		<!--<form action="process_vulnerable.php?action=login" method="post">
			
			<input type="text" name="user">
			<input type="password" name="pass">
			<input type="submit" value="Iniciar sesion">
			
		</form>-->
		<?php
	}
	?>
</body>
</html>