<?php
include "../config.php";
include "header.php";

$quiz_id = isset($_GET['id']) ? $_GET['id'] : null;
if (!$quiz_id) {
    die("Error: Course ID not provided in URL.");
}

$check_course = $conn->query("SELECT id FROM quiz WHERE id = $quiz_id");
if ($check_course->num_rows == 0) {
    die("Error: Quiz id  $quiz_id not found in the database.");
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['options1'])) {
    $question = $_POST['question'];
    $question_num = $_POST['question_num'];
    $number_options = $_POST['number_options'];

    $insert_sql = "INSERT INTO questions (quiz_id, question_num, question) VALUES ('$quiz_id','$question_num','$question')";
    $conn->query($insert_sql);

    $question_id = $conn->insert_id;

    for ($i = 1; $i <= $number_options; $i++) {
        $option = $_POST['options' . $i];
        $status = isset($_POST['is_correct' . $i]) ? 1 : 0;

        $options_sql = "INSERT INTO answers (question_id, option, is_correct) VALUES ('$question_id', '$option', '$status')";
        $conn->query($options_sql);
    }

    echo "<p class='quiz-success'>✅ Question and options saved successfully!</p>";
    $sql= "SELECT course_id FROM quiz WHERE id = '$quiz_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $course_id = $row['course_id'];
    $sql= "SELECT quiz_name FROM quiz WHERE id = '$quiz_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $quiz_name = $row['quiz_name'];
    header("Location: ../enroll.php?quiz_id=$quiz_id&id=$course_id&quiz=$quiz_name");
    exit;
}

elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['number_options']) && !isset($_POST['options1'])) {
    $number_options = $_POST['number_options'];
    $question = $_POST['question'];
    $question_num = $_POST['question_num'];

    echo "<div class='quiz-question-form'>";
    echo "<h2>Enter Options</h2>";
    echo "<form action='quiz.php?id=$quiz_id' method='POST'>";
    for ($i = 1; $i <$number_options; $i++) {
        echo "<label>True</label><input type='hidden' name='options$i' value='True' required> ";
        echo "<label><input type='checkbox' name='is_correct$i'> Is correct</label><br><br>";
    }
    for ($i = 2; $i <= $number_options; $i++) {
        echo "<label>False</label><input type='hidden' name='options$i' value='False' required> ";
        echo "<label><input type='checkbox' name='is_correct$i'> Is correct</label><br><br>";
    }
    echo "<input type='hidden' name='question' value='" . htmlspecialchars($question) . "'>";
    echo "<input type='hidden' name='question_num' value='$question_num'>";
    echo "<input type='hidden' name='number_options' value='$number_options'>";
    echo "<input type='submit' value='Submit Options'>";
    echo "</form></div>";
}

else {
// ?>
    <div class="quiz-question-form">
        <h2>Add True/False</h2>
        <form action="add_true.php?id=<?php echo $quiz_id; ?>" method="POST">
            <label>Question Number:</label>
            <input type="number" name="question_num" value="<?php
            $sql= "SELECT question_num FROM questions WHERE quiz_id = $quiz_id";
            $result = $conn->query($sql);
            
            $question_num = $result->num_rows+1;
            
            echo $question_num;
            
            ?>"required><br><br>
            <label>Question:</label>
            <input type="text" name="question" required><br><br>
            
            <input type="hidden" name="number_options" value="2"><br><br>
            <input type="submit" value="Next">
        </form>
    </div>
<?php  }?>
