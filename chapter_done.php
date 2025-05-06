<?php
include "header.php";

$chapter_id=$_GET['id'];

$user_id=$_SESSION['user_id'];



$sql= "SELECT * from chapters_done WHERE user_id=$user_id";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
if(isset($row['chapters_completed'])){
$chapter_completed=$row['chapters_completed'];}

if(isset($chapter_completed)){

    $chapter_completed= $chapter_completed. $chapter_id;
    $sql = "UPDATE chapters_done SET chapters_completed ='$chapter_completed' WHERE user_id= $user_id";
    if($conn->query($sql))
{
    echo "Inserted successfully";
    $sql= "SELECT course_id from chapters where id=$chapter_id ";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $course_id=$row['course_id'];

header("Location: enroll.php?id=$course_id");
}
else{
    echo "query Failed";
}
}
else{

$sql="INSERT into chapters_done (user_id, chapters_completed) VALUES ('$user_id','$chapter_completed')";
if($conn->query($sql))
{
    echo "Inserted successfully";
}
}
?>

<script>
    function changeVideo(url, title, checkboxId) {
        const autoplayUrl = url.includes("?") ? url + "&autoplay=1&mute=1" : url + "?autoplay=1&mute=1";
        document.getElementById("videoFrame").src = autoplayUrl;
        document.getElementById("video-title").textContent = title;

        const checkbox = document.getElementById(checkboxId);
        if (checkbox) checkbox.checked = true;

        const allCheckboxes = document.querySelectorAll(".checks");
        const allChecked = Array.from(allCheckboxes).every(cb => cb.checked);

        if (allChecked) {
            document.getElementById("completion-message").style.display = "block";
        }
    }
</script>
