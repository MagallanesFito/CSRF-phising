<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ejemplo csrf</title>
</head>
<body>
	<?php
	// Login protegido con token de autenticacion
	if(isset($_SESSION["user"])){
		echo("<h3>Hola " .$_SESSION["user"]."</h3>");
		$_SESSION['token'] = md5(uniqid(mt_rand(),true));
		echo('<a href="process.php?action=logout&csrf='.$_SESSION['token'].'">Cerrar sesion</a>');
	}
	else{
		?>
		<form action="process.php?action=login" method="post">
			<input type="hidden" name="csrf" value="<?php echo $_SESSION["token"];?>">
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