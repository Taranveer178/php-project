<?php
include "../config.php";
include "header.php";
include "delete.php";

$sql = "SELECT * FROM course WHERE deleted_at IS NOT NULL";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Recover Courses</h2>";
    echo "<table border='1' class='table_data'>";
    echo "<tr>
            <th>Course Name</th>
            <th>Recover</th>
            <th>Delete Permanently</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['course_name'] . "</td>";
        echo "<td><a href='recover_courses.php?action=recover&id=" . $row['id'] . "'>Recover</a></td>";
        echo "<td><a href='recover_courses.php?action=delete&id=" . $row['id'] . "'>Delete</a></td>";
        echo "</tr>";
    }
    
    echo "</table>";
} else {
    echo "<p>No courses available for recovery.</p>";
}

if(isset($_GET['id'])){
    $course_id = $_GET['id'];
    $action = $_GET['action'];

    if($action=='recover'){
    $sql = "UPDATE course SET deleted_at = NULL WHERE id = $course_id";
    
        if($conn->query($sql)){
            // echo "<p>Course recovered successfully!</p>";
            header("Location: recover_courses.php");
            exit;
        } else {
            echo "<p>Error recovering course: " . $conn->error . "</p>";
        }
    }
    elseif($action=='delete'){
        // 1. Fetch the image filename for the course
        $sql = "SELECT image FROM course WHERE id = $course_id";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();

        if ($row) {
            $image_filename = $row['image'];
            $image_path = "../uploads/" . $image_filename;

            // 2. Delete the image file if it exists
            if (file_exists($image_path)) {
                unlink($image_path);
            }
}


        $table= 'course';
        $delete_id=$course_id;
        $delete_obj->delete($table, $delete_id);
        // $sql = "DELETE FROM course WHERE id = $course_id";
        
        // if($conn->query($sql)){
            // echo "<p>Course deleted permanently!</p>";
            header("Location: recover_courses.php");
            exit;
        // } else {
        //     echo "<p>Error deleting course: " . $conn->error . "</p>";
        // }
    }
}

?>