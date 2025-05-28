<?php

include "../config.php";
include "delete.php";

$question_id = $_GET['id'];

$sql="SELECT questions.quiz_id,questions.question_num, quiz.quiz_name, quiz.course_id  from questions LEFT JOIN quiz ON questions.quiz_id=quiz.id WHERE questions.id=$question_id";


$result = $conn->query($sql);
$row = $result->fetch_assoc();
$quiz_id = $row['quiz_id'];

$quiz_name = $row['quiz_name'];
$course_id = $row['course_id'];


if ($row) {
    $deleted_question_num = $row['question_num'];



        $table= 'questions';
        $delete_id=$question_id;
        $delete_obj->delete($table, $delete_id);
        $delete_question = "DELETE FROM questions WHERE id = '$question_id'";

        $update_sql = "UPDATE questions 
                       SET question_num = question_num - 1 
                       WHERE quiz_id = '$quiz_id' AND question_num > '$deleted_question_num'";
        $conn->query($update_sql);


        
        header("Location: ../enroll.php?quiz_id=$quiz_id&id=$course_id&quiz=$quiz_name");
    exit;
    } else {
        echo "❌ Error deleting question: " . $conn->error;
    }

?>
