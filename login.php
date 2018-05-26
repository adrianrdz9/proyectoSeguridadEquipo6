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
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">

</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="./">
            <img src="./logo.png" alt="Logo" width="120">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="formulario.php" class="nav-link">Registrarse</a>
                </li>
            </ul>
        </div>
    </nav>

	<div class="container">
		<div class="card text-center mt-4">
			<div class="card-header bg-info text-light">
                Iniciar sesion
            </div>
			<div class="card-body">
			<form method='post' action='loginP.php' id='form'>
				<div class="form-group">
					Nombre de usuario: <br/>
					<input type='text' name='usu' required placeholder='Usuario' class="form-control"/><br/>
				</div>
				
				<div class="form-group">
					Contraseña:<br/>
					<input type='password' name='pas' autocomplete='off' minlength='25' size='30'
					required placeholder="Contraseña" class="form-control"/> <br/>
				</div>
				
				<p><input type='submit' value='Enviar' id="enviar" class="btn btn-primary" /></p>
			</form>

			</div>
		</div>
	</div>

</body>
</html>
