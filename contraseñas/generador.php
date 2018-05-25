<?php
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
    return implode($gu);
}

echo contr();
