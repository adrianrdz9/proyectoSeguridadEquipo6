<?php
	include('./cifrado.php');

	function val($r,$s,$n){//funcion para validacion
		if (!preg_match($r,$s)){
			echo "Formato de $n invalido <br/>";
			return 1;
		}else{
			echo $n.':'.' '.'<br/>'.$s.'<br/>';
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
		 echo 'Email:<br/>'.$em.'<br/>';
		} else {
		 echo $em.' '.'no es un email valido <br/>';
		 $e = $e + 1;
	}
	$e += val ("/[A-Za-z0-9._%+-]/",$usu,'Usuario');
	$e += val ("/([A-Z]+[a-z]+[0-9]+|[\.]|[\=]|[\)]|[\(]|[\/]|[\&]|[\%]|[\$]|[\#]|[\!]|[\*]|[\+]|[\´]|[\~]|[\#]|[\_]|[\+]|[\{]|[\}]|[\|]|[\[]|[\]]|[\;]|[\:]|[\"]|[\<]|[\>]|[\?]|[\,][^(13245)|(qwert)|(asdfg)|(zxcv)|aaa|ooo|eee|iii|uuu][^ñ|á|í|ó|ú|ü|ö|Á|É|Í|Ó|Ú|Ü|Ö])+/",$pas,'Password');
	 if ($e==0){
		$usuario = $usu;
		$nombre = cifrar($nom, $usuario);
		$ap_pat = cifrar($pat, $usuario);
		$ap_mat = cifrar($mat, $usuario);
		$lada = cifrar($lada, $usuario);
		$telefono = cifrar($tel, $usuario);
		$email = cifrar($em, $usuario);
		$contrasenia = md5($pas);

		$bd = mysqli_connect('127.0.0.1', 'root', 'toor', 'gestor');


		$usuario = mysqli_real_escape_string ($bd, $usuario);
		$nombre = mysqli_real_escape_string ($bd, $nombre);
		$ap_pat = mysqli_real_escape_string ($bd, $ap_pat);
		$ap_mat = mysqli_real_escape_string ($bd, $ap_mat);
		$lada = mysqli_real_escape_string ($bd, $lada);
		$telefono = mysqli_real_escape_string ($bd, $telefono);
		$email = mysqli_real_escape_string ($bd, $email);
		$contrasenia = mysqli_real_escape_string ($bd, $contrasenia);
	

		$query = "INSERT INTO usuario(nombre, apellido_paterno, apellido_materno, lada, telefono, email, usuario, contrasenia)";
		$query = $query .    " VALUES('$nombre', '$ap_pat', '$ap_mat', '$lada', '$telefono', '$email', '$usuario', '$contrasenia')";

		if(!mysqli_query($bd, $query)){
			echo "Error: ".$query."<br>". mysqli_error($bd);
		}

		$id = mysqli_insert_id($bd);
		mysqli_close($bd);
		setcookie(md5("id"), cifrar($id, "cookie"), 0, "/");
		header('Location: ./');

	}else{
		 echo "<a href='formulario.php'>Regresar al formulario</a>";
	 }

?>
