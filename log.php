<?php

session_start();
require('functions.php');
require('apache.php');

if(isset($_SERVER['PHP_AUTH_USER'])){
    if(checkUser(createDbConnection(), $_SERVER['PHP_AUTH_USER'],$_SERVER['PHP_AUTH_PW'])){
    $_SESSION["user2"] = $_SERVER['PHP_AUTH_USER'];
   

    json_encode( array("info"=>"Kirjauduit sisään") );
    exit;

   echo '{"info":"Kirjauduit sisään!"}';
    header('Content-Type: application/json');
    exit;
    }
}

/*echo'{"error":"Failed to login"}';*/
header('Content-Type: application/json');
header('HTTP/1.1 401');
exit;


createUser(createDbConnection(), "Jasmin", "Brunni", "jasminbrunni", "niiskuneiti11");
createUser(createDbConnection(), "Risto", "Reipas", "Reippaana", "fnkss");
createUser(createDbConnection(), "Mikko", "Mallikas", "pirate10", "jotainjotain");
createUserData(createDbConnection(), "Mikko.mallikas@outlook.com", "0503345643");
createUserData(createDbConnection(),"Heinähattu2@hotmail.com", "0447768954");

/*$json = json_decode(file_get_contents('php://input'));

$fname = filter_var($json->fname, FILTER_SANITIZE_STRING);
$lname = filter_var($json->lname, FILTER_SANITIZE_STRING);
$username = filter_var($json->username, FILTER_SANITIZE_STRING);
$passwd = filter_var($json->passwd, FILTER_SANITIZE_STRING);

if( checkUser(createDbConnection(),"jasmin", "brunni")){
    $_SESSION["username] = "niiskuneiti11";
    echo "oikea salasana";
    }else{
        echo "väärä salasana!";

}*/

?>
