<?php
include "header.php";
include "../config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $question=$_POST['question'];
    $answer=$_POST['answer'];

    $sql="INSERT into faq (question, answer) VALUES ('$question', '$answer')";
    if($conn->query($sql)){
        header("Location: ../index.php");
    }
}
?>
<div class="quiz-question-form">
    <h2>Edit Quiz Question</h2>
    <form action="add_faq.php" method="POST">
        

        <label>Question:</label>
        <input type="text" name="question" required><br><br>
        <label>Answer</label>
        <input type="text" name="answer" required><br><br>

        <input type="submit" value="Submit">
    </form>
</div>