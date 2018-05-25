<?php
    setcookie(md5("id"), "");
    setcookie(md5("id"), "", 1, "/");
    header("Location: ./")
?>