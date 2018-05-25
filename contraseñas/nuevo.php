<?php
    if( empty( $_COOKIE[md5('id')] )   ){
        header("Location: ../formulario.php");
    }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	<style>
		input{
			border: 0;
			background-color: transparent;
			width: auto;
		}
	</style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <a class="navbar-brand" href="../">
            <img src="../logo.png" alt="Logo" width="120">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item mr-4">
                    <a class="nav-link" href="../">Inicio</a>
                </li>
                <li class="nav-item mr-4">
                    <a class="nav-link" href="./nuevo.php">Agregar contraseña</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./">Ver todas las contraseñas</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="../logout.php" class="nav-link">Cerrar sesion</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class='card text-center mt-4'>
            <div class='card-header bg-info text-light'>  
                Nueva contraseña
            </div>
            <form action="./nueva.php" method="POST" class="mt-4" id="form">
                <div class="form-group w-75 m-auto">
                    <label for="service">Servicio</label>
                    <select name="service" id="service" class="custom-select">
                        <option value="facebook">Facebook</option>
                        <option value="twitter">Twitter</option>
                        <option value="google_services">Google Services</option>
                        <option value="hotmail">Hotmail</option>
                        <option value="github">Github</option>
                        <option value="spotify">Spotify</option>
                    </select>
                </div>

                <div class="form-group w-75 m-auto">
                    <label for="reference" class="mt-2">Referencia - opcional</label>
                    <input type="text" class="form-control" name="reference" id="reference">
                    <small class="form-text text-muted">Una forma de saber a que cuenta corresponde esta esta contraseña</small>
                </div>

                <div class="form-group w-75 m-auto">
                    <label for="password" class="d-block mt-2">Contraseña</label>
                    <input type="password" class="form-control w-75 d-inline" name="password" id="password" minlength="25" maxlength="30" required 
                    pattern='([A-Za-z0-9]+|[\.]|[\=]|[\)]|[\(]|[\/]|[\&]|[\%]|[\$]|[\#]
                    |[\!]|[\*]|[\+]|[\´]|[\~]|[\#]|[\_]|[\+]|[\{]|[\}]|[\|]|[\[]|[\]]|[\;]|
                    [\:]|[\"]|[\<]|[\>]|[\?]|[\,][^(13245)|(qwert)|(asdfg)|(zxcv)|aaa|ooo|eee|iii|uuu]
                    [^ñ|á|í|ó|ú|ü|ö|Á|É|Í|Ó|Ú|Ü|Ö])+'>
                    <div class="w-25 d-inline">
                        <button class="btn d-inline">Generar</button>
                    </div>
                    <small class="form-text text-muted mb-4">
                        Minimo 25 caracteres, por lo menos una letra mayuscula, una letra minuscula, un numero, un simbolo, sin caracteres  latinos y sin sucesiones logicas (ej. 12345). 
                    </small>
                </div>

                <div class='card-footer text-muted'>
                    <input type="submit" value="Guardar" class="btn btn-link" id="enviar">
                </div>
            </form>
            <div id="avisos">
                <h1></h1>
                <ul></ul>
            </div>
        </div>
             


    </div>
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

	<script>
        document.querySelector('#enviar').addEventListener("click", function(ev){
            var request = new XMLHttpRequest();

            request.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    
                    var response = JSON.parse(this.responseText);
                    if(document.querySelector('#password').value.length < 25 && response.errores <= 0){
                            response.errores += 1;
                            response[0] = "Contraseña muy corta"
                    }
                    
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

            request.open('POST', './nueva.php', true);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            var datos = "";
            document.querySelectorAll('input:not([type="submit"])').forEach((el, i, arr)=>{
                datos += el.name;
                datos += "=";
                datos += encodeURIComponent(el.value);
                datos+="&";
                
            })
            datos += "ajax=true";
            
            
            request.send(datos);
        
            
            
            
            ev.preventDefault();
        })
    </script>

</body>
</html>