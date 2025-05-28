<?php
include "../config.php";
include "header.php";

$id = $_GET['id'];
 
 
 $sql ="SELECT username from users where id='$id'";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $username = $row['username'];
 
    
    
?>
<div class="progress">
    <h1>Progress of <?php echo $username; ?></h1>
    
   

    
<table border="1" cellpadding="10" cellspacing="0" class="enroll-table">
    <tr class="enroll-row">
        <th class='enroll-header'>Course Name</th>
        <th class='enroll-header'>Chapters Status</th>
        <th class='enroll-header'>Quiz Completed</th>
        
    </tr>

    <?php
    

    // Get user's enrolled and completed course IDs
    $sql = "SELECT * FROM enrolled WHERE user_id = '$id'";
    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        $enrolled_courses = explode(' ', trim($row['enrolled_courses']));
        $completed_courses = explode(' ', trim($row['completed']));
        $completed_quiz = isset($row['completed_quiz']) ? explode(' ', trim($row['completed_quiz'])) : [];

        

        foreach ($enrolled_courses as $course_id) {
            $course_id = intval($course_id);
            $course_sql = "SELECT course_name FROM course WHERE id = '$course_id'";
            $course_result = $conn->query($course_sql);

            if ($course_result && $course_row = $course_result->fetch_assoc()) {
                $course_name = htmlspecialchars($course_row['course_name']);
                $status = in_array($course_id, $completed_courses) ? "Completed" : "In Progress";
                $quiz_sql = "
                        SELECT q.quiz_name 
                        FROM quiz_result qr 
                        JOIN quiz q ON qr.quiz_id = q.id 
                        WHERE qr.course_id = '$course_id' AND qr.user_id = '$id'
                    ";
                        $quiz_result = $conn->query($quiz_sql);

                        $quiz_names = [];
                        while ($quiz_row = $quiz_result->fetch_assoc()) {
                            $quiz_names[] = $quiz_row['quiz_name'];
                        }

                        $quiz_list = implode(', ', $quiz_names); // Join quiz names with commas
                
               

                echo "<tr class='enroll-row'>";
                echo "<td class='enroll-cell'>$course_name</td>";
                echo "<td class='enroll-cell'>$status </td>";
                echo "<td class='enroll-cell'>$quiz_list</td>";    
                echo "</tr>";
            }
        }
    } else {
        echo "<tr><td colspan='2'>No enrolled courses found.</td></tr>";
    }
    ?>
</table>

   
   
   
   
    

</div>