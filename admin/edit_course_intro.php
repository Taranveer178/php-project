<?php
include '../config.php';
include 'header.php';

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];

    // Fetch existing course info
    $sql = "SELECT * FROM course WHERE id = $course_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['course_name'];
        $description = $_POST['description'];
        $skills = $_POST['skills'];
        $about = $_POST['about'];

        $file_name = $_FILES['image']['name'];
        $tmp_name = $_FILES['image']['tmp_name'];
        $destination = "../uploads/" . $file_name;

        // If image uploaded
        if (!empty($file_name)) {
            move_uploaded_file($tmp_name, $destination);
            $sql = "UPDATE course SET course_name='$name', description='$description', skills='$skills', about='$about', image='$file_name' WHERE id='$course_id'";
        } else {
            $sql = "UPDATE course SET course_name='$name', description='$description', skills='$skills', about='$about' WHERE id='$course_id'";
        }

        if ($conn->query($sql)) {
            echo "<p style='color: green;'>Updated successfully!</p>";
            header("Location: ../course_intro.php?id=$course_id");
        } else {
            echo "<p style='color: red;'>Update failed: " . $conn->error . "</p>";
        }


        $result = $conn->query("SELECT * FROM course WHERE id = $course_id");
        $row = $result->fetch_assoc();
    }
}
?>
<form action="edit_course_intro.php?id=<?php echo $course_id; ?>" method="POST" enctype="multipart/form-data" class="edit-course-form" id="editCourseForm">
    <div class="form-group">
        <label for="courseName" class="form-label">Course Name:</label>
        <input type="text" id="courseName" name="course_name" class="form-input" value="<?php echo $row['course_name'] ?? ''; ?>">
    </div>

    <div class="form-group">
        <label for="description" class="form-label">Description:</label>
        <input type="text" id="description" name="description" class="form-input" value="<?php echo $row['description'] ?? ''; ?>">
    </div>

    <div class="form-group">
        <label for="skills" class="form-label">Skills:</label>
        <input type="text" id="skills" name="skills" class="form-input" value="<?php echo $row['skills'] ?? ''; ?>">
    </div>

    <div class="form-group">
        <label for="about" class="form-label">About:</label>
        <input type="text" id="about" name="about" class="form-input" value="<?php echo $row['about'] ?? ''; ?>">
    </div>

    <div class="form-group">
        <label class="form-label">Current Image:</label><br>
        <img src="../uploads/<?php echo $row['image'] ?? ''; ?>" width="100" height="60" class="course-image" id="currentImage">
    </div>

    <div class="form-group">
        <label for="imageUpload" class="form-label">Upload New Image:</label>
        <input type="file" id="imageUpload" name="image" class="form-input">
    </div>

    <div class="submit-button-container">
        <input type="submit" value="Submit" class="form-submit-btn" id="submitBtn">
    </div>
</form>
