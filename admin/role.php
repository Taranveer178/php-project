<?php
include "../config.php";
include "header.php";

$id=$_GET['id'];

$sql="SELECT role from users where id =$id";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$role= $row['role'];

if($role=='admin'){
    $sql= "UPDATE users set role ='user' WHERE id=$id";
    if($conn->query($sql))
    {
        echo "role updated";
    }
}
elseif($role=='user'){
    $sql= "UPDATE users set role ='admin' WHERE id=$id";
    if($conn->query($sql))
    {
        echo "role updated";
    }
}
?>