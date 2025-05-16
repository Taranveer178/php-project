<?php
include "header.php";

$course_id=$_GET['id'];
$chapter_num=$_GET['chapter_num'];


$user_id=$_SESSION['user_id'];

$select_sql= "SELECT * from chapters where course_id=$course_id and Chapter_number=$chapter_num";
$result=$conn->query($select_sql);
$row=$result->fetch_assoc();
$chapter_id=$row['id'];


   $sql= "SELECT completed_chapters from enrolled WHERE user_id='$user_id'";
            $result= $conn->query($sql);
            $row=$result->fetch_assoc();
            $completed_chapters =$row['completed_chapters'] ?? '';


            $completed_chapters_array= explode(separator: ' ',string: $completed_chapters);

            if (!in_array($chapter_id, $completed_chapters_array)) {

                $new_completed_chapters= "$completed_chapters"." $chapter_id"; 
                
                
                echo    "<br>";
                $sql = "UPDATE enrolled SET completed_chapters = '$new_completed_chapters' WHERE user_id = '$user_id'";
                if ($conn->query($sql)) {
                    echo "user id ".$user_id;
                    echo "<br>";
                     echo $new_completed_chapters;
                
                    $sql= "SELECT * from chapters where id=$chapter_id";
                    $results=$conn->query($sql);    
                    $rows=$results->fetch_assoc();
                    $course_id = $rows['course_id'];
                    echo "INSERTED";
                    $chapter_num= $chapter_num+1;

                    header("Location: enroll.php?id=$course_id&chapter_num=$chapter_num");
                    exit;
                } 
            }
            else{
                $chapter_num= $chapter_num+1;
                 header("Location: enroll.php?id=$course_id&chapter_num=$chapter_num");
                    exit;
            }



?>

<script>
    // function changeVideo(url, title, checkboxId) {
    //     const autoplayUrl = url.includes("?") ? url + "&autoplay=1&mute=1" : url + "?autoplay=1&mute=1";
    //     document.getElementById("videoFrame").src = autoplayUrl;
    //     document.getElementById("video-title").textContent = title;

    //     const checkbox = document.getElementById(checkboxId);
    //     if (checkbox) checkbox.checked = true;

    //     const allCheckboxes = document.querySelectorAll(".checks");
    //     const allChecked = Array.from(allCheckboxes).every(cb => cb.checked);

    //     if (allChecked) {
    //         document.getElementById("completion-message").style.display = "block";
    //     }
    // }
</script>
