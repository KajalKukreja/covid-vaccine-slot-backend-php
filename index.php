<?php
    header("Access-Control-Allow-Origin: http://localhost:4200");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers");
    header("Access-Control-Allow-Methods: GET, POST");

    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $host = $_SERVER['HTTP_HOST']."/";
    $uri = $_SERVER['REQUEST_URI'];
    
    if(strpos($uri, '?member') !== false) {
        $domain = substr($uri, 0, strpos($uri, '?'));
        $domain = str_replace('/', '', $domain);
        $query_string = "?email=".$_GET['email']."&mobile_no=".$_GET['mobile_no']."&pincode=".$_GET['pincode']."&district_id=".$_GET['district_id']."&age=".$_GET['age']."&dose=".$_GET['dose'];
        header("Location: ".$protocol.$host.$domain."/api/v1/member/add_member.php".$query_string);
        exit();
    }
    else if(strpos($uri, '?recaptcha') !== false) {
        $domain = substr($uri, 0, strpos($uri, '?'));
        $domain = str_replace('/', '', $domain);
        $query_string = "?response=".$_GET['response'];
        header("Location: ".$protocol.$host.$domain."/api/v1/verify_recaptcha.php".$query_string);
        exit();
    }
    else if(strpos($uri, '?unsubscribe') !== false) {
        $domain = substr($uri, 0, strpos($uri, '?'));
        $domain = str_replace('/', '', $domain);
        $query_string = "?email=".$_GET['email'];
        header("Location: ".$protocol.$host.$domain."/api/v1/unsubscribe.php".$query_string);
        exit();
    }
?>
<html>
    <head></head>
    <body>
        Backend for covid-vaccine-slot application
    </body>
</html>