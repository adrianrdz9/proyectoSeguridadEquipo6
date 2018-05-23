<?php
	$e = 0;
	function val($r,$s,$n){//funcion para validacion
		if (!preg_match($r,$s)){
			echo "Formato de $n invalido <br/>";
			$e = $e + 1;
		}
		 else
			echo $n.':'.' '.'<br/>'.$s.'<br/>';
	}
	//recibir los valores
	 $nom = $_POST['nom'];
	 $pat= $_POST['pat'];
	 $mat= $_POST['mat'];
	 $lada= $_POST['lada'];
	 $tel= $_POST['tel'];
	 $em= $_POST['em'];
	 $usu= $_POST['usu'];
	 $pas= $_POST['pas'];
	 val ("/[A-Za-z]/",$nom,Nombre);
	 val ("/[A-Za-z]/",$pat,ApellidoPaterno);
	 val ("/[A-Za-z]/",$mat,ApellidoMaterno);
	 val ("/[+][0-9]/",$lada,Lada);
	 val ("/[0-9]/",$tel,Telefono);
	 if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
		 echo 'Email:<br/>'.$em.'<br/>';
		} else {
		 echo $em.' '.'no es un email valido <br/>';
		 $e = $e + 1;
	}
	 val ("/[A-Za-z0-9._%+-]/",$usu,Usuario);
	 val ("/[^ñ|á|í|ó|ú|ü|ö|Á|É|Í|Ó|Ú|Ü|Ö][A-Za-z0-9][\.][\=][\)][\(][\/][\&][\%][\!][\*][\+][\´][\~][\#][\_][\+][\{][\}][\|][\[][\;][^(13245)|(qwert)|(asdfg)|(zxcv)|aaa|ooo|eee|iii|uuu]/",$pas,Password);
	 if ($e==0){
		 echo "<a href='contraseñas.html'>Registrar contraseñas</a>";//pagina para registra contraseñas
	 }else{
		 echo "<a href='formulario.html'>Regresar al formulario</a>";
	 }

?>
