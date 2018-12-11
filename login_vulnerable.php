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
	<title>Ejemplo csrf</title>
</head>
<body>
	<?php
	if(isset($_SESSION["user"])){
		echo("<h3>Hola " .$_SESSION["user"]."</h3>");
		echo('<a href="process_vulnerable.php?action=logout">Cerrar sesion</a>');
		?>
		<br><br>
		<label>Saldo actual: </label>
		
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
		    		echo("<p> $ " .$row['cantidad']."</p>");
		    		break;
		    	}
		        //echo($row['Usuario']." ".$row['cantidad']);
		    }
		    /* liberar el conjunto de resultados */
		    $resultado->close();
		}
?>



		<br><br>
		<label>Transferir dinero</label>
		<form action="process_vulnerable.php?action=transfer" method="post">
			<input type="text" name="destinatary"><br><br>
			<input type="number" name="quantity"><br><br>
			<input type="submit" value="Procesar" name="">
			<br><br>
		</form>
		<?php 
	}
	else{
		?>
		<form action="process_vulnerable.php?action=login" method="post">
			<!-- admin-->
			<input type="text" name="user">
			<input type="password" name="pass">
			<input type="submit" value="Iniciar sesion">
			
		</form>
		<?php
	}
	?>
</body>
</html>