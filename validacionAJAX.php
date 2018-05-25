<?php
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
	$e = 0;

	//recibir los valores
	 $nom = $_POST['nom'];
	 $pat= $_POST['pat'];
	 $mat= $_POST['mat'];
	 $lada= $_POST['lada'];
	 $tel= $_POST['tel'];
	 $em= $_POST['em'];
	 $usu= $_POST['usu'];
	 $pas= $_POST['pas'];
	 $e += val ("/[A-Za-z]/",$nom,'Nombre');
	 $e += val ("/[A-Za-z]/",$pat,'ApellidoPaterno');
	 $e += val ("/[A-Za-z]/",$mat,'ApellidoMaterno');
	 $e += val ("/[+][0-9]/",$lada,'Lada');
	 $e += val ("/[0-9]/",$tel,'Telefono');
	 if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
    } else {
        array_push($respuesta,  "Email invalido");
        $e += 1;
	}
	$e += val ("/[A-Za-z0-9._%+-]/",$usu,'Usuario');
	$e += val ("/([A-Z]+[a-z]+[0-9]+|[\.]|[\=]|[\)]|[\(]|[\/]|[\&]|[\%]|[\$]|[\#]|[\!]|[\*]|[\+]|[\´]|[\~]|[\#]|[\_]|[\+]|[\{]|[\}]|[\|]|[\[]|[\]]|[\;]|[\:]|[\"]|[\<]|[\>]|[\?]|[\,][^(13245)|(qwert)|(asdfg)|(zxcv)|aaa|ooo|eee|iii|uuu][^ñ|á|í|ó|ú|ü|ö|Á|É|Í|Ó|Ú|Ü|Ö])+/",$pas,'Password');
    $respuesta['errores'] = $e;
    echo json_encode($respuesta);

?>
