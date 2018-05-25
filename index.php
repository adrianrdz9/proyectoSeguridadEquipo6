<?php
    if( empty( $_COOKIE[md5('id')] )   ){
        header("Location: ./formulario.php");
    }

    include('./cifrado.php');

    $id =  descifrar($_COOKIE[md5('id')], 'cookie');

    $bd = mysqli_connect('127.0.0.1', 'root', 'toor', 'gestor');


    $query = "SELECT * FROM usuario WHERE id = ".$id;
    $res = mysqli_query($bd, $query);
    $resultados = [];
    if($res){
        while($row = mysqli_fetch_assoc($res)){
            foreach ($row as $key => $val) {
                $resultados[$key] = $val;
            }
        }

        unset($resultados["id"]);
        unset($resultados["contrasenia"]);

        foreach ($resultados as $key => $value) {
            if($key != "usuario")
                $resultados[$key] = descifrar($value, $resultados["usuario"]);
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
            <ul class="navbar-nav mr-auto">
                <li class="nav-item mr-4">
                    <a class="nav-link" href="./">Inicio</a>
                </li>
                <li class="nav-item mr-4">
                    <a class="nav-link" href="./contraseñas/nuevo.php">Agregar contraseña</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./contraseñas/">Ver todas las contraseñas</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">Cerrar sesion</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <div class="card text-center mt-4">
            <div class="card-header bg-info text-light">
                Datos personales
            </div>
            <div class="card-body">
                <p><span class="font-weight-bold">Nombre: </span><?php echo $resultados["nombre"] ?></p>
                <p><span class="font-weight-bold">Apellido paterno: </span><?php echo $resultados["apellido_paterno"] ?></p>
                <p><span class="font-weight-bold">Apellido materno: </span><?php echo $resultados["apellido_materno"] ?></p>
                <p><span class="font-weight-bold">Lada: </span><?php echo $resultados["lada"] ?></p>
                <p><span class="font-weight-bold">Telefono: </span><?php echo $resultados["telefono"] ?></p>
                <p><span class="font-weight-bold">Usuario: </span><?php echo $resultados["usuario"] ?></p>
                
            </div>
            <div class="card-footer text-muted">
                <a href="./editar.php">Editar</a>
            </div>
        </div>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>
</html>