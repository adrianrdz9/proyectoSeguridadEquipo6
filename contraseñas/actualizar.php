<?php
    if( empty( $_COOKIE[md5('id')] )   ){
        header("Location: ../formulario.php");
    }

    $respuesta = [];
	function val($r,$s,$n){//funcion para validacion
		if (!preg_match($r,$s)){
            global $respuesta;
            array_push($respuesta,  "$n invalido");
			return 1;
		}else{
		    return 0;
		}
    }
    $pas = $_POST["password"];

    $e = val ("/([A-Z]+[a-z]+[0-9]+|[\.]|[\=]|[\)]|[\(]|[\/]|[\&]|[\%]|[\$]|[\#]|[\!]|[\*]|[\+]|[\´]|[\~]|[\#]|[\_]|[\+]|[\{]|[\}]|[\|]|[\[]|[\]]|[\;]|[\:]|[\"]|[\<]|[\>]|[\?]|[\,][^(13245)|(qwert)|(asdfg)|(zxcv)|aaa|ooo|eee|iii|uuu][^ñ|á|í|ó|ú|ü|ö|Á|É|Í|Ó|Ú|Ü|Ö])+/",$pas,'Password');
    $respuesta["errores"] = $e;
    echo json_encode($respuesta);

    if(empty($_POST["ajax"])){
        include('../cifrado.php');
        $id =  descifrar($_COOKIE[md5('id')], 'cookie');
    
        $bd = mysqli_connect('127.0.0.1', 'root', 'toor', 'gestor');

        $query = "SELECT username FROM usuario WHERE id = ".$id;
        $res = mysqli_query($bd, $query);
        $username = "";
        if($res){
            $row = mysqli_fetch_assoc($res);
            $username = $row["usuario"];
        }

        $id_servicio = $_POST["q"];
        $query = "SELECT * FROM servicio WHERE id=$id_servicio";
        $res = mysqli_query($bd, $query);
        $user = "";
        if($res){
            $row = mysqli_fetch_assoc($res);
            $servicio = $row;
        }

        if($servicio['id_usuario'] != $id){
            header("Location: ./");
        }

        $nombre = $_POST["service"];
        $referencia = $_POST["reference"];
        $contrasenia = $_POST["password"];
        
        $nombre = cifrar($nombre, $username);
        $referencia = cifrar($referencia, $username);
        $contrasenia = cifrar($contrasenia, $username);


        $nombre = mysqli_real_escape_string($bd, $nombre);
        $referencia = mysqli_real_escape_string($bd, $referencia);
        $contrasenia = mysqli_real_escape_string($bd, $contrasenia);
    
        $query = "UPDATE servicio SET nombre = '$nombre', referencia='$referencia', contrasenia='$contrasenia' WHERE  id = $id_servicio";
        if(!mysqli_query($bd, $query)){
            echo "Error: ".$query."<br>". mysqli_error($bd);
        }else{
            header("Location: ./");
        }
        
    }

   


?>

