<?php

session_start();
require('functions.php');
require('log.php');


if(isset($_SESSION["user2"])){
    exit;
}

$requestHeaders = apache_request_headers();

if( isset($requestHeaders['Authorization'])){

    $auth_value = explode(' ', $requestHeaders['Authorization']);
}


?>