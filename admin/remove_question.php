<?php

include "../config.php";

$question_id = $_GET['id'];

$sql="SELECT quiz_id FROM questions WHERE id = $question_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$quiz_id = $row['quiz_id'];

$sql="SELECT quiz_name, course_id FROM quiz WHERE id = $quiz_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$quiz_name = $row['quiz_name'];
$course_id = $row['course_id'];

// Step 1: Get the question_num and quiz_id of the deleted question
$sql = "SELECT question_num, quiz_id FROM questions WHERE id = $question_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($row) {
    $deleted_question_num = $row['question_num'];
    // $course_id = $row['quiz_id'];

    // Step 2: Delete associated answers
    $delete_answers = "DELETE FROM answers WHERE question_id = '$question_id'";
    $conn->query($delete_answers);

    // Step 3: Delete the quiz question
    $delete_question = "DELETE FROM questions WHERE id = '$question_id'";
    if ($conn->query($delete_question)) {

        // Step 4: Update question numbers
        $update_sql = "UPDATE questions 
                       SET question_num = question_num - 1 
                       WHERE quiz_id = '$quiz_id' AND question_num > '$deleted_question_num'";
        $conn->query($update_sql);


        
        header("Location: ../enroll.php?quiz_id=$quiz_id&id=$course_id&quiz=$quiz_name");
    exit;
    } else {
        echo "❌ Error deleting question: " . $conn->error;
    }
} else {
    echo "❌ Question not found.";
    
}
?>
