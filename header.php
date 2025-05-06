<?php
session_start();
$_SESSION['role']='visitor';

include 'config.php';


if(isset($_SESSION['email'])){
$email=$_SESSION['email'];

$sql= "SELECT id from users where email= '$email'";
$result= $conn->query($sql);
$row= $result->fetch_assoc();
$id= $row['id'];




$sql= "SELECT role from role where user_id = '$id'"; 
$result=$conn->query($sql);
$row=$result->fetch_assoc();

if($row['role']=='admin'){
  $_SESSION['role']='admin';
}
elseif($row['role']=='user'){
  $_SESSION['role']='user';
}


}



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="style.css" />
  <title>LMS Platform</title>
</head>
<body>
  <header class="header">
    <div class="logo">
      <a href="index.php"><img src="./img/logo.jpg" alt="Logo" /></a>
    </div>
    <nav class="nav">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="index.php#courses">Courses</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
        <?php 
        if(isset($_SESSION['name'])){
        if($row['role']=='admin'){
    echo "<a href='admin\user_data.php'><input type= 'button' class=''admin-button' value='Admin' style='background-color: #1558c0; height: 40px; width:100px; border:none; border-radius:5px; cursor:pointer; color:white'></a>";}
}?>
   

        <?php if (!isset($_SESSION['name'])): ?>
          <li><a href="login.php" class="btn login">Login</a></li>
        <?php else: ?>
          <li class="profile">
            <a href="dashboard.php">
              <img src="img/profile.png" alt="Profile" />
              <span><?= $_SESSION['name'] ?></span>
            </a>
          </li>
          <li><a href="logout.php" class="btn logout">Logout</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
