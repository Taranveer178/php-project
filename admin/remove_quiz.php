<?php

include "../config.php";

$quiz_id = $_GET['id'] ?? null;

$sql = "SELECT course_id FROM quiz WHERE id = '$quiz_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$course_id = $row['course_id'];
// echo $course_id;




$remove_sql = "DELETE FROM quiz WHERE id = '$quiz_id'"; 
if($conn->query($remove_sql)){
   
    
    header("Location: ../enroll.php?id=$course_id");
    exit;
} else {
    echo "<p class='quiz-error'>Error removing quiz: " . $conn->error . "</p>";
}

?>