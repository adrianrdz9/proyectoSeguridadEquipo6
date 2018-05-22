<?php
	function val($r,$s,$n){//funcion para validacion
		if (!preg_match($r,$s))
			echo "Formato de $n invalido <br/>";
		 else
			echo $s.'<br/>';
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
	 val ("/[0-9]{10}/",$tel,Telefono);
	 val ("/[A-Za-z0-9._%+-]+@[a-z]+[.]?[a-z]'/",$em,Email);
	 val ("/[A-Za-z0-9._%+-]/",$usu,Usuario);
	 val ("/([A-Za-z0-9]+|[\.]|[\=]|[\)]|[\(]|[\/]|[\&]|[\%]|[\#]
	 |[\!]|[\*]|[\+]|[\´]|[\~]|[\#]|[\_]|[\+]|[\{]|[\}]|[\|]|[\[]|[\]]|[\;]|
	 [\:]|[\<]|[\>]|[\?]|[\,])/",$pas,Password);
?>
