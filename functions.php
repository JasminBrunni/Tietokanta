<?php

function createDbConnection(){

    try{
        $dbcon = new PDO('mysql:host=localhost;dbname=c0brja00', 'root', '');
        $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
        echo $e->getMessage();
    }
    
    return $dbcon;
    }


function createUser(PDO $dbcon, $fname, $lname, $username, $passwd){

    $fname = filter_var($fname, FILTER_SANITIZE_STRING);
    $lname = filter_var($lname, FILTER_SANITIZE_STRING);
    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $passwd = filter_var($passwd, FILTER_SANITIZE_STRING);

    try{
        $hash_pw = password_hash($passwd, PASSWORD_DEFAULT);
        $sql = "INSERT IGNORE INTO user2 (fname, lname, username, passwd) VALUES(?,?,?,?)";
        $prepare = $dbcon->prepare($sql);
        $prepare->execute(array( $fname, $lname, $username, $hash_pw));
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}

function createUserData(PDO $dbcon, $email, $phonenumber){

    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $phonenumber = filter_var($phonenumber, FILTER_SANITIZE_STRING);

    try{
        $sql = "INSERT IGNORE INTO user_data (email, phonenumber) VALUES (?,?)";
        $prepare = $dbcon->prepare($sql);
        $prepare->execute(array($email, $phonenumber));
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }

}


function checkUser(PDO $dbcon, $username, $passwd){

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $passwd = filter_var($passwd, FILTER_SANITIZE_STRING);

    try{
        $sql = "SELECT password FROM user2 WHERE username=?"; 
        $prepare = $dbcon->prepare($sql);   
        $prepare->execute(array($username));  

        $rows = $prepare->fetchAll();

    
        foreach($rows as $row){
            $pw = $row["password"];  
            if( password_verify($passwd, $pw) ){  
                return true;
            }
        }

       
        return false;

    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }
}



/*function createTable($con){
    $sql = "CREATE TABLE IF NOT EXISTS user2(
        id varchar(50) NOT NULL,
        fname varchar(50) NOT NULL,
        lname varchar(50) NOT NULL,
        username varchar(50) NOT NULL,
        passwd varchar(50) NOT NULL,
        PRIMARY KEY (id)
    )";

    try{

        $con->exec($sql);
    }catch(PDOException $e){
        echo '<br>'.$e->getMessage();
    }

}*/

?>