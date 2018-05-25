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
</head>
<body>
	<form method='post' action='formularioP.php' id='form'>
		Nombre: <br/>
		<input type='text' name='nom' required pattern='[A-Za-z]+' title='Ingresa solo letras'/> <br/>
		Apellido Paterno: <br/>
		<input type='text' name='pat' required pattern='[A-Za-z]+' title='Ingresa solo letras' /> <br/>
		Apellido Materno: <br/>
		<input type='text' name='mat' required pattern='[A-Za-z]+' title='Ingresa solo letras' /> <br/>
		Telefono: <br/>
		<input type='text'name='lada' required pattern='[+]?\d{2}' maxlength='3' size='3' title='Lada Ejemplo: +52'/>
		<input type='text'name='tel' required pattern='\d{10}' maxlength='10' size='10'title='Ingresa solo números (10 digitos)'/> <br/>
		Email: <br/>
		<input type='email' name='em' required pattern='[A-Za-z0-9._%+-]+@[a-z]+[.]?[a-z]+' title='Formato email'/> <br/>
		Nombre de usuario: <br/>
		<input type='text' name='usu' required pattern='[A-Za-z0-9._%+-]+'/><br/>
		Contraseña:<br/>
		<input type='password' name='pas' autocomplete='off' minlength='25' size='30'
		required pattern='([A-Za-z0-9]+|[\.]|[\=]|[\)]|[\(]|[\/]|[\&]|[\%]|[\$]|[\#]
		|[\!]|[\*]|[\+]|[\´]|[\~]|[\#]|[\_]|[\+]|[\{]|[\}]|[\|]|[\[]|[\]]|[\;]|
		[\:]|[\"]|[\<]|[\>]|[\?]|[\,][^(13245)|(qwert)|(asdfg)|(zxcv)|aaa|ooo|eee|iii|uuu]
		[^ñ|á|í|ó|ú|ü|ö|Á|É|Í|Ó|Ú|Ü|Ö])+'
		title='Mayusculas, minusculas, número y caracteres espaciales'/> <br/>
		<p><input type='submit' value='Enviar' id="enviar"/></p>
		<div id="avisos">
			<h1></h1>
			<ul></ul>
		</div>
	</form>


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
