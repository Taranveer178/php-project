<?php
include "header.php";
include "../config.php";

$course_id = $_GET['id'] ?? null;

if (isset($_GET['name'])) {
    $name = $_GET['name'];
    $total_points = $_GET['points'];
    $passing_marks = $_GET['passing_marks'];

    // Fix SQL syntax: commas between values
    $sql = "INSERT INTO quiz (course_id, total_points, quiz_name, passing_marks) 
            VALUES ('$course_id', '$total_points', '$name', '$passing_marks')";
    
    if ($conn->query($sql)) {
        header("Location: ../enroll.php?id=$course_id");
        exit;
    }
}
?>



<div class="quiz-form-container">
    <form action="create_quiz.php" method="get" class="quiz-form">
        <h2>Create a New Quiz</h2>

        <div class="form-group">
            <label for="name">Quiz Name:</label>
            <input type="text" name="name" id="name" class="input-field" required>
        </div>

        <div class="form-group">
            <label for="points">Total Points:</label>
            <input type="number" name="points" id="points" class="input-field" required>
        </div>

        <div class="form-group">
            <label for="passing_marks">Passing Marks:</label>
            <input type="number" name="passing_marks" id="passing_marks" class="input-field" required>
        </div>

        <input type="hidden" name="id" value="<?php echo $course_id; ?>">

        <input type="submit" value="Create Quiz" class="submit-btn">
    </form>
</div>

