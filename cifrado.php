<?php
//Permitir caracteres UTF-8
ini_set('default-charset', 'UTF-8');

//Regresa una cadena con $texto cifrado con $llave
function cifrar($texto, $llave){
  $llave = str_split($llave);
  $largoLlave = count($llave);
  $texto = str_split($texto);

  //Obtener unicamente valores numericos de la llave
  foreach ($llave as $key => $value) {
    $llave [$key] = ord($value);
  }

  //Igualar el largo de la llave al largo de texto
  $i = 0;
  while(count($llave) < count($texto)){
    array_push($llave, $llave[$i]);
    $i++;
  }

  foreach ($texto as $key => $value) {
    //El numero de caracteres que se va a desplazar el caracter
    //original 
    $offset = $llave[$key] % ($largoLlave % 10 +1);
    $texto[$key] = chr(ord($value) + $offset +1);
  }
  //Convierte el array en string
  return implode($texto);
}

//Regresa una cadena con $cifrado descifrado con $llave
function descifrar($cifrado, $llave){
  $llave = str_split($llave);
  $largoLlave = count($llave);
  $cifrado = str_split($cifrado);

  //Obtener unicamente valores numericos de la llave
  foreach ($llave as $key => $value) {
    $llave [$key] = ord($value);
  }

  //Igualar el largo de la llave al largo de texto
  $i = 0;
  while(count($llave) < count($cifrado)){
    array_push($llave, $llave[$i]);
    $i++;
  }

  foreach ($cifrado as $key => $value) {
    //El numero de caracteres que se desplazo el caracter
    //original 
    $offset = $llave[$key] % ($largoLlave % 10+1);
    $cifrado[$key] = chr(ord($value) - ($offset +1));
  }

  //Convierte el array en string
  return implode($cifrado);
}


