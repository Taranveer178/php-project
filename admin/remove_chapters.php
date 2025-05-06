<?php
include "../config.php";

if (isset($_GET['id'])) {
    echo $_GET['id'];
    $chapter_id = $_GET['id'];
    $sql = "SELECT * FROM chapters WHERE id = $chapter_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $course_id=$row['course_id'];
    $chapter_num=$row['Chapter_number'];

    $sql = "DELETE FROM chapters WHERE id=$chapter_id";
    if($conn->query($sql)){
        echo "deleted";
      

        // $sql= "SELECT Chapter_number from chapters WHERE course_id= $course_id";
        $sql = "UPDATE Chapters SET Chapter_number = Chapter_number - 1 WHERE course_id = $course_id AND id> $chapter_id ";
        $conn->query($sql);
        header("Location: ../enroll.php?id=$course_id");
    }

}

?>