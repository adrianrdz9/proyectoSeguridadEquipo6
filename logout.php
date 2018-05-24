<?php
    setcookie(md5("usuario"), "");
    setcookie(md5("usuario"), "", 1, "/");
    header("Location: ./")
?>