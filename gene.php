<?php
//generador de contraseñas
    function contr(){
      $ge = "abcdefghijklmnop@#~$%()=*+qrstuvwxyz1234567890ABCDEFGHIJKLMNOPQRSTabcdefghijkUVWXYZ|@#~$%()=*+7890ABCDEFGHI[]{}-_!&/~^";
      $ge = str_shuffle($ge);//revuelve
      $l = mt_rand(25,33);//determina largo
      $a = 0;
      while ($a<$l){
        $x = mt_rand(0,83);
        $gu[$a] = $ge[$x];
        $a = $a + 1;
      }
      return $gu;
    }
    function lle(){
        $pru = contr();
        foreach ($pru as $dato_password) {
          echo $dato_password;
        }
    }
    echo "<form method='post' action='contra.php'>";
    echo "<h1>Registro de contraseñas</h1>";
      //<!--Instrucciones de que se hace aqui(registrar contraseñas)-->
    echo "</br>Facebook:    ";
    $f = lle();
    echo "</br>Twitter:     ";
    $t = lle();
    echo "</br>Google Services:   ";
    $g = lle();
    echo "</br>Hotmail:    ";
    $h = lle();
    echo "</br>GitHub:     ";
    $u = lle();
    echo "</br>Spotify:    ";
    $s = lle();
    echo  "<p><input type='submit' value='Enviar' /></p>";
      echo "</form>";
?>
