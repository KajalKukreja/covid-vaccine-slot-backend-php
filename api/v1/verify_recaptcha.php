<?php
    header("Access-Control-Allow-Origin: http://localhost:4200");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");
    header("Access-Control-Allow-Methods: GET, POST");

    require "config.php";

    $url = $GLOBALS['RECAPTCHA_ENDPOINT']."?secret=".$GLOBALS['RECAPTCHA_SECRET_KEY']."&response=".$_GET['response'];
    $response = file_get_contents($url);
    echo $response;
?>