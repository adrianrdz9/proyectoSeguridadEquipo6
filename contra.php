<?php
  $f=$_POST['f'];
  $t=$_POST['t'];
  $GS=$_POST['GS'];
  $H=$_POST['H'];
  $GH=$_POST['GH'];
  $S=$_POST['S'];
  $k = 0;
  function val($c,$n){
    if($c!=""){
        $l = strlen($c);//largo palabra
        $m = preg_match_all('/[A-Za-z0-9.=\/&%$#!°();:,´<>?~^*+_{}|]/',$c);
        if ($m!=$l){//numero de coincidencias necesarias para que sea valida
            echo "<p>Formato de contraseña incorrecta: $c </p>";
            echo "<p>Asignar otra contraseña para: $n </p>";
            $k = $k + 1;
          }
        else{
          echo "<p>Contraseña valida: $c </p>";
          echo "<p>Contraseña establecida para: $n</p>";
        }
    }
    else {
        echo "No se establecio contraseña para $n";
    }
    return $k;
  }
  if($f==$t||$f==$GS||$f==$H||$f==$GH||$f==$S||$t==$f||$t==$GS||$t==$H||$t==$GH||$t==$S||
     $H==$f||$H==$t||$H==$GH||$H==$GS||$H==$S||$GH==$f||$GH==$t||$GH==$H||$GH==$GS||$GH==$S||
     $GS==$f||$GS==$t||$GS==$H||$GS==$GH||$GS==$S||$S==$f||$S==$t||$S==$H||$S==$GS||$S==$GH){
    echo "<p>Contraseñas iguales, no son permitidas</p>";
    echo "<a href='contrase.html'>Generar nuevas contraseñas</a>";
  }else{
    $a = val($f,"Facebook");
    $b = val($t,"Twitter");
    $c = val($GS,"Google Services");
    $d = val($H,"Hotmail");
    $e = val($GH,"GitHub");
    $f = val($S,"Spotify");
    $k = $a + $b + $c + $d + $e + $f;
    if ($k>0)
      	echo "<a href='contrase.html'>Generar nuevas contraseñas</a>";
    else
      echo "La direccion de la siguiente pagina";
  }
 ?>
