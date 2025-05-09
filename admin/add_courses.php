<?php
    include "../config.php";
    include "header.php";
    if (!$conn){
        die("Connection failed");
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name=$_POST['course_name'];
        $description=$_POST['description'];
        $skills=$_POST['skills'];
        $about=$_POST['about'];
        $file_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];

        

        $tmp_name = $_FILES['image']['tmp_name'];
    
  
        
        $ext = pathinfo($file_name, PATHINFO_EXTENSION);
        $new_name = "img_" . $name . "." . $ext;
        $destination = "../uploads/" . $new_name;

        $sql = "INSERT INTO course (course_name, description, skills, about, image) 
            VALUES ('$name', '$description', '$skills', '$about', '$new_name')";
        $conn->query($sql);
   
        if (move_uploaded_file($tmp_name, $destination)) {
            $sql= "SELECT id from course where course_name='$name'";
            $result=$conn->query($sql);
            $row=$result->fetch_assoc();
            $course_id = $row['id'];
            // echo $course_id;
            header ("Location: add_chapters.php?id=$course_id");
        } else {
            echo "File upload failed.";
        }
    }
    

?>
<form class="courses-form" action="add_courses.php" method="POST" enctype="multipart/form-data" >
    <br><br>Course Name: <input type="text" name="course_name" id="" required><br><br>
    Description: <input type="text" name="description" id="" required><br><br>
    Skills <input type="text" name="skills" id="" required><br><br>
    About <input type="text" name="about" id="" required><br><br>
    Image <input type="file" name="image" id="" required><br><br>
    <input type="submit" value="submit">
</form>