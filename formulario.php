<?php
    if(!empty( $_COOKIE[md5('id')] )   ){
        header("Location: ./");
	}
	
?>


<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
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
                    <a href="login.php" class="nav-link">Iniciar sesion</a>
                </li>
            </ul>
        </div>
    </nav>
	<div class="container">
		<div class="card text-center mt-4">
			<div class="card-header bg-info text-light">
                Registrarse
            </div>
			<div class="card-body">
				<form method='post' action='formularioP.php' id='form' class="w-75 m-auto">
					<div class="form-group">
						Nombre: 
						<input type='text' name='nom' required pattern='[A-Za-z]+' placeholder='Ingresa solo letras' class="form-control"/> 
					</div>
					
					<div class="form-group">
						Apellido Paterno: 
						<input type='text' name='pat' required pattern='[A-Za-z]+' placeholder='Ingresa solo letras' class="form-control"/> 
					</div>
					
					<div class="form-group">
						Apellido Materno: 
						<input type='text' name='mat' required pattern='[A-Za-z]+' placeholder='Ingresa solo letras' class="form-control"/> 
					</div>
					
					<div class="form-group">
						Telefono: <br>
						<input type='text'name='lada' required pattern='[+]?\d{2}' maxlength='3' size='3' placeholder='Lada Ejemplo: +52' class="form-control w-25 d-inline-block"/>
						<input type='text'name='tel' required pattern='\d{10}' maxlength='10' size='10'placeholder='Ingresa solo números (10 digitos)' style="width:70%;" class="form-control d-inline-block"/> 
					</div>

					<div class="form-group">
						Email: 
						<input type='email' name='em' required pattern='[A-Za-z0-9._%+-]+@[a-z]+[.]?[a-z]+' placeholder='Formato email' class="form-control"/> 
					</div>
					
					<div class="form-group">
						Nombre de usuario: 
						<input type='text' name='usu' required pattern='[A-Za-z0-9._%+-]+' class="form-control"/>
					</div>

					<div class="form-group">
						Contraseña:
						<input type='password' name='pas' autocomplete='off' minlength='25' size='30'
						required pattern='([A-Za-z0-9]+|[\.]|[\=]|[\)]|[\(]|[\/]|[\&]|[\%]|[\$]|[\#]
						|[\!]|[\*]|[\+]|[\´]|[\~]|[\#]|[\_]|[\+]|[\{]|[\}]|[\|]|[\[]|[\]]|[\;]|
						[\:]|[\"]|[\<]|[\>]|[\?]|[\,][^(13245)|(qwert)|(asdfg)|(zxcv)|aaa|ooo|eee|iii|uuu]
						[^ñ|á|í|ó|ú|ü|ö|Á|É|Í|Ó|Ú|Ü|Ö])+'
						placeholder='Mayusculas, minusculas, número y caracteres espaciales' class="form-control"/> 
					</div>
					
					
					<p><input type='submit' value='Enviar' id="enviar" class="btn btn-primary"/></p>
					<div id="avisos">
						<h1></h1>
						<ul></ul>
					</div>
				</form>
			</div>
			
		</div>
	</div>
	
	


	<script>
		document.querySelector('#enviar').addEventListener("click", function(ev){
			var request = new XMLHttpRequest();

			request.onreadystatechange = function(){
				if(this.readyState == 4 && this.status == 200){
					
					var response = JSON.parse(this.responseText);
					
					if(response.errores <= 0){
						document.querySelector('#form').submit();
					}else{
						var contenedor = document.querySelector('#avisos');
						contenedor.getElementsByTagName('h1')[0].innerHTML = "Errores (" + response.errores + "):"
						contenedor.getElementsByTagName('ul')[0]
							.innerHTML = ""
						for(var i = 0; i < response.errores; i++){
							contenedor.getElementsByTagName('ul')[0]
							.innerHTML += "<li>" + response[i] + "</li>";
						}
						
					}
				}
			}

			request.open('POST', './validacionAJAX.php', true);
			request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			var datos = "";
			document.querySelectorAll('input:not([type="submit"])').forEach((el, i, arr)=>{
				datos += el.name;
				datos += "=";
				datos += encodeURIComponent(el.value);
				if(arr[i+1]){
					datos+="&";
				}
			})

			
			
			request.send(datos);
		
			
			
			
			ev.preventDefault();
		})
	</script>

</body>
</html>
