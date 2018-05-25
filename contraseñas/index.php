<?php
    if( empty( $_COOKIE[md5('id')] )   ){
        header("Location: ../formulario.php");
    }

    include('../cifrado.php');

    $id =  descifrar($_COOKIE[md5('id')], 'cookie');

    $bd = mysqli_connect('127.0.0.1', 'root', 'toor', 'gestor');

    $query = "SELECT usuario FROM usuario WHERE id=$id";
    $res = mysqli_query($bd, $query);
    $user = "";
    if($res){
        $row = mysqli_fetch_assoc($res);
        $user = $row['usuario'];
    }
    $query = "SELECT servicio.id, servicio.nombre, servicio.referencia, servicio.contrasenia FROM usuario INNER JOIN servicio ON $id = servicio.id_usuario";
    $res = mysqli_query($bd, $query);
    $resultados = [];
    if($res){
        while($row = mysqli_fetch_assoc($res)){
            $r = [];
            foreach ($row as $key => $val) {
                if($key == 'id')
                    $r[$key] = $val;
                else
                    $r[$key] = descifrar($val, $user);
            }
            array_push($resultados, $r);
            
        }
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
            font-size: 0.8em;
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

        <?php 
            foreach ($resultados as $el) {
                echo "
                <div class='card text-center mt-4'>
                    <div class='card-header bg-info text-light'>  
                        ".$el['nombre']."
                    </div>
                    <p><span class='font-weight-bold'>Referencia: </span> 
                        ".$el['referencia']."
                    </p>
                    <p>
                        <span class='font-weight-bold mr-2'>Contraseña: </span> 
                        <input type='password' class='w-75' disabled value='".$el['contrasenia']."' >
                        <div class='buttons'>
                            <button class='btn btn-sm ver'>Ver</button>
                            <button class='btn btn-sm copiar'>Copiar</button>
                        </div>
                        
                    </p>
                    <div class='card-footer text-muted'>
                        <a href='#' elId='".$el["id"] ."' class='editar'>Editar</a>
                    </div>
                </div>
                
                
                ";
            }
        ?>



    </div>


    <div class="modal" tabindex="-1" role="dialog" id='reingreso'>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reingresa tu contraseña</h5>
            </div>
            <div class="modal-body">
                <form action="./editar.php" id="reingresoF" method="POST">
                    <input type="password" name="pw" class='form-control' placeholder="Contraseña">
                    <input type="hidden" name="q" id="q">
                    <input type="submit" value="Continuar" class="btn">
                </form>
            </div>
            </div>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>

	<script>
		document.querySelectorAll('.ver').forEach((el)=>{
            $(el).on('click', function(ev){
                let pw = $($(ev.target)[0]).parent().prev().children().last();
                if($(pw).attr('type') == "password"){
                    $(pw).attr('type', 'text');
                    $(ev.target).html('Ocultar');
                }else{
                    $(pw).attr('type', 'password');
                    $(ev.target).html('Ver');
                }
            })
        })


        document.querySelectorAll('.copiar').forEach((el)=>{
            $(el).on('click', function(ev){
                let pw = $($(ev.target)[0]).parent().prev().children().last();
                s = $(pw).attr('type');
                $(pw).attr('type', 'text');
                $(pw).prop('disabled', false);

                $(pw).select();
                document.execCommand('copy');
                $(ev.target).html('Copiado').prop('disabled', true);
                setTimeout(() => {
                    $(ev.target).html('Copiar').prop('disabled', false);
                }, 1000);

                $(pw).attr('type', s);
                $(pw).prop('disabled', true);
            })
        })

        document.querySelectorAll(".editar").forEach(function(el){
            el.addEventListener("click", function(ev){
                ev.preventDefault();
                $('#q').val($(ev.target).attr('elId') );
                $('#reingreso').modal();
            })
        })
        
        

	</script>

</body>
</html>