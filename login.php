<?php
    if(!empty( $_COOKIE[md5('id')] )   ){
        header("Location: ./");
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Iniciar sesion</title>
	<meta charset="utf-8"/>
</head>
<body>
	<form method='post' action='loginP.php' id='form'>
		Nombre de usuario: <br/>
		<input type='text' name='usu' required placeholder='Usuario'/><br/>
		Contraseña:<br/>
		<input type='password' name='pas' autocomplete='off' minlength='25' size='30'
		required placeholder="Contraseña"/> <br/>
		<p><input type='submit' value='Enviar' id="enviar"/></p>
	</form>

</body>
</html>
