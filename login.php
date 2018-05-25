<?php
    include('./cifrado.php');
    $usuario = $_POST['usu'];
    $password = $_POST['pas'];

    $bd = mysqli_connect('127.0.0.1', 'root', 'toor', 'gestor');

    $usuario = mysqli_real_escape_string ($bd, $usuario);
    $password = mysqli_real_escape_string($bd, md5($password));

    $query = "SELECT id FROM usuario WHERE usuario = '".$usuario."'";
    $query = $query . " AND contrasenia = '".$password."'";
    $res = mysqli_query($bd, $query);
    if($res){
        while($row = mysqli_fetch_assoc($res)){
            foreach ($row as $key => $val) {
                $id = $val;
            }
        }

        if(empty($id)){
            echo "<script>alert('Usuario o contraseña incorrectos');window.location.replace('./login.html')</script>";
        }else{
            setcookie(md5("id"), cifrar($id, 'cookie'), 0, "/");
            header("Location: ./");
        }
    }




?>