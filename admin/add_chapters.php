<?php
include "../config.php";
include "header.php";


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$course_id = $_GET['id'] ?? $_POST['courseId'] ?? null;



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['chapter_name']) && is_array($_POST['chapter_name'])) {
    $chapter_names = $_POST['chapter_name'];
    $links = $_POST['link'];
    $chapter_nums=$_POST['chapter_num'];

    for ($i = 0; $i < count($chapter_names); $i++) {
        $chapter = mysqli_real_escape_string($conn, $chapter_names[$i]);
        $link = mysqli_real_escape_string($conn, $links[$i]);
        $chapter_num=mysqli_real_escape_string($conn, $chapter_nums[$i]);

        if (!empty($chapter) && !empty($link)) {
            $sql = "INSERT INTO chapters (chapter_name, link, course_id, Chapter_number) VALUES ('$chapter', '$link', '$course_id', '$chapter_num')";
            if (!$conn->query($sql)) {
                echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
            }
            else header("Location: ../enroll.php?id=$course_id");
        }
    }

    echo "<p style='color: green; text-align: center;'>Chapters added successfully!</p>";
}
?>


<div class="chapters-form" style="padding: 20px;">
    <form action="add_chapters.php?id=<?= $course_id ?>" method="POST">
        <input type="hidden" name="courseId" value="<?= $course_id ?>">
        <label>Enter number of chapters: </label>
        <input type="number" name="number" min="1" required>
        <input type="submit" value="Submit">
    </form>

    <?php

    if (isset($_POST['number']) && is_numeric($_POST['number'])) {
        $num = intval($_POST['number']);
        echo "<form action='add_chapters.php' method='POST'><br>";
        echo "<input type='hidden' name='courseId' value='$course_id'>";

        $sql="SELECT id from chapters WHERE course_id= $course_id";
        $result=$conn->query($sql);
        $row_count=$result->num_rows;
        

        for ($i = 0; $i < $num; $i++) {
            echo "Chapter " . ($row_count + 1+ $i) . ": ";
        
            
            echo "<input type='hidden' name='chapter_num[]' value=".($row_count + 1+ $i)." required> ";
            echo "<input type='text' name='chapter_name[]' placeholder='Chapter name' required> "; 
            echo "<input type='text' name='link[]' placeholder='Video link' required><br><br>";
            
        }
        echo "<input type='submit' value='Add Chapters'>";
        echo "</form>";
    }
    ?>
</div>

<!-- <?php include "../footer.php"; ?> -->
