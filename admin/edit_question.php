<?php
include "../config.php";
include "header.php";

$question_id = $_GET['id'];

// Fetch question data
$sql = "SELECT 
            questions.quiz_id, 
            questions.question_num, 
            questions.question, 
            quiz.quiz_name, 
            quiz.course_id 
        FROM  questions 
        LEFT JOIN quiz ON questions.quiz_id = quiz.id 
        WHERE questions.id=$question_id ";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$quiz_id = $row['quiz_id'];
$selected_question_num = $row['question_num'];
$selected_question = $row['question'];

$quiz_name = $row['quiz_name'];
$course_id = $row['course_id'];

// Fetch options with IDs
$sql = "SELECT id, option, is_correct FROM answers WHERE question_id = $question_id";
$result = $conn->query($sql);
$options = [];
while ($row = $result->fetch_assoc()) {
    $options[] = $row;
}
$number_options = count($options);

// Handle POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $_POST['question'];
    $question_num = $_POST['question_num'];

    $update_sql = "UPDATE questions SET question_num = '$question_num', question = '$question' WHERE id = $question_id";
    if ($conn->query($update_sql) === TRUE) {

        for ($i = 0; $i < $number_options; $i++) {
            $option_id = $options[$i]['id'];
            $option_text = $conn->real_escape_string($_POST['options' . ($i + 1)]);
            $status = isset($_POST['is_correct' . ($i + 1)]) ? 1 : 0;

            $options_sql = "UPDATE answers SET option = '$option_text', is_correct = '$status' WHERE id = $option_id";
            $conn->query($options_sql);
        }

        // echo "<p class='quiz-success'>✅ Question and options updated successfully!</p>";
       
        header("Location: ../enroll.php?id=$course_id&quiz_id=$quiz_id&quiz=$quiz_name&question_num=$question_num");
        exit;
    } else {
        echo "❌ Error updating question: " . $conn->error;
    }
}
?>

<div class="quiz-question-form">
    <h2>Edit Quiz Question</h2>
    <form action="edit_question.php?id=<?php echo $question_id; ?>" method="POST">
        <label>Question Number:</label>
        <input type="number" name="question_num" value="<?php echo $selected_question_num; ?>" required><br><br>

        <label>Question:</label>
        <input type="text" name="question" value="<?php echo htmlspecialchars($selected_question); ?>" required><br><br>

        <?php for ($i = 0; $i < $number_options; $i++): ?>
            <label>Option <?php echo $i + 1; ?>:</label>
            <input type="text" name="options<?php echo $i + 1; ?>" value="<?php echo htmlspecialchars($options[$i]['option']); ?>" required>
            <label><input type="checkbox" name="is_correct<?php echo $i + 1; ?>" <?php echo $options[$i]['is_correct'] ? 'checked' : ''; ?>> Is correct</label>
            <br><br>
        <?php endfor; ?>

        <input type="submit" value="Update">
    </form>
</div>
