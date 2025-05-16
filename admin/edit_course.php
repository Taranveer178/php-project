<?php
include "../config.php";
include "header.php";

$course_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Chapter_number'])) {
 $chapter_id = $_POST['chapter_id'];   
$Chapter_number= $_POST['Chapter_number'];
$chapter_name= $_POST['chapter_name'];
$link= $_POST['link'];

$sql= "UPDATE chapters SET Chapter_number = '$Chapter_number', chapter_name = '$chapter_name', link = '$link' WHERE course_id = $course_id AND id = $chapter_id";
if($conn->query($sql)){
    echo "<p class='quiz-success'>✅ Course updated successfully!</p>";
} else {
    echo "<p class='quiz-error'>❌ Error updating course: " . $conn->error . "</p>";
}
}

?>



<table class='table_data' border=1>
    <tr>
        <th style ='width:20px'>S.No </th>
        <th style='width:200px;'>Chapter</th>
        <th>Link</th>
        <th>View</th>
        <th>Update</th>
        <th style='width:200px;'>Delete</th>
    </tr>
    <?php
    $sql = "SELECT * FROM chapters where course_id = $course_id AND deleted_at IS NULL ORDER BY Chapter_number";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
       
        
        while ($row = $result->fetch_assoc()) {
        echo "<form action='edit_course.php?id=" . $course_id . "' method='POST'>";
        echo "<tr>";
        echo "<td><input type='text' name='Chapter_number' value=\"" . htmlspecialchars($row['Chapter_number']) . "\"></td>";
        echo "<td><input type='text' name='chapter_name' value=\"" . htmlspecialchars($row['chapter_name']) . "\"></td>";
        echo "<td><input type='text' name='link' value=\"" . htmlspecialchars($row['link']) . "\"></td>";
        echo "<td><a href='" . $row['link'] . "' target='_blank'>View</a></td>";
        echo "<td><input type='hidden' name='chapter_id' value=\"" . htmlspecialchars($row['id']) . "\">
        <input type='submit' value='Save Changes'></td>";
        echo "<td><button onclick=\"window.location.href='remove_chapters.php?id=" . $row['id'] . "'\" class='delete-btn'>Delete</button></td>";
        echo "</tr>";
        echo "</form>";
       
    }
  
    } else {
        echo "<tr><td colspan='3'>No chapters found.</td></tr>";
    }
    ?>
        
</table>

 <?php if ($_SESSION['role'] == 'admin') {
                echo "<a href='add_chapters.php?id=" . $course_id . "' style='text-decoration:none;'><input type='button' class='admin-btn' style='position:relative; width: auto;' value='Add Chapters'></a>";
                echo "<a href='remove_chapters.php?course_id=" . $course_id . "' style='text-decoration:none;'><input type='button' class='admin-btn' style='position:relative; width:auto;' value='Recover Chapters'></a>";
            }?>
<a href="../enroll.php?id=<?php echo $course_id; ?>" style="padding: 8px 16px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">
    Go Back
</a>

    
