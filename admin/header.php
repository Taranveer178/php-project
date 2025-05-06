<?php
session_start();

$role=$_SESSION['role'];

if($role=='admin'){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | LMS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="admin-header">
        <div class="admin-logo">
            <a href="../index.php">
                <img src="../img/logo.jpg" alt="Logo" width="180px">
            </a>
        </div>
        <nav class="admin-nav">
            <ul>
                
                <li><a href="user_data.php">Users</a></li>
                <li><a href="add_courses.php">Add Course</a></li>
                <li><a href="messages.php">Messages</a></li>

                <?php
                if (!isset($_SESSION['user_id'])) {
                    header ("Location: ../index.php");
                } else {
                    echo "<li class='profile-item'>
                            <a href='user_data.php'>
                                <img src='../img/profile.png' alt='Profile' class='profile-img'>
                                <span>{$_SESSION['name']}</span>
                            </a>
                          </li>";
                    echo "<li><a href='../logout.php'><button class='btn logout-btn'>Logout</button></a></li>";
                }
                ?>
            </ul>
        </nav>
    </header>

<?php }
else{
header("Location: ../login.php");
}?>