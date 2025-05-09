<?php
include "config.php";

if (isset($_GET['id'])) {
    echo $_GET['id'];
    $course_id = $_GET['id'];
    // $sql = "SELECT * FROM course WHERE id = $course_id";
    // $result = $conn->query($sql);
    // $row = $result->fetch_assoc();
    // echo $row['course_name'];


    
    $sql = "UPDATE course SET deleted_at = NOW() WHERE id = $course_id";
    
    if($conn->query($sql)){
        echo "deleted";
        header("Location: ./index.php#courses");
    }

}

?>