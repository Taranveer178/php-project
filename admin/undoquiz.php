<?php
include '../config.php';
include 'header.php';

$quiz_id = isset($_GET['id']) ? $_GET['id'] : null;
$course_id = isset($_GET['course_id']) ? $_GET['course_id'] : null;



$sql= "DELETE FROM quiz_result WHERE quiz_id = $quiz_id";
if($conn->query($sql)){
    header("Location: ../enroll.php?id=$course_id&quiz=1&quiz_id=$quiz_id");
    exit;
}

?>