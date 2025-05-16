<?php
$server="localhost";
$username="root";
$password="";
$database="php";




$conn= mysqli_connect($server, $username, $password, $database);
if(!$conn){
    die("Connection failed");
}
// else{
//     echo "Connection Established";
// }


?>