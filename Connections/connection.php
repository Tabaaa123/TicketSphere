<?php
function connection(){
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "capstone";
    $con = new mysqli($host, $username, $password, $database);
    
    if($con->connect_error){
        echo $con->connect_error;
        }else{
         "Server is running on port 3001";
       return $con;
       }  
    }  
?>