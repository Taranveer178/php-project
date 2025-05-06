<?php
include "header.php";
include "config.php";
$session_role = $_SESSION["role"];
// echo $session_role;

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $sql = "SELECT * FROM course WHERE id = $course_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}
?>

<div class="course-container">
<?php if($_SESSION['role']=='admin'){
        echo "<a href='admin/edit_course_intro.php?id=".$row['id']."'><input type='button' class='admin-btn'style='position:absolute; margin-left:85%;' value='Edit'></a>";}?>
    <div class="course-wrapper">
        <h2 class="course-badge"><?php echo $row["course_name"]; ?> - Free Course with Certification</h2>
        
        <h1 class="course-title"><?php echo $row["course_name"]; ?> Course for Beginners</h1>
        
        <p class="course-description"><?php echo $row["description"]; ?></p>

        <?php
            $enrolled = false;
            if(isset($_SESSION['user_id'])){
        
            $user_id=$_SESSION['user_id'];
            $sql="SELECT enrolled_courses from enrolled WHERE user_id ='$user_id'";
            $result= $conn->query($sql);
            $rows=$result->fetch_assoc();

            $enrolled_course = isset($rows['enrolled_courses']) ? $rows['enrolled_courses'] : '';

            $enrolled_courses_array= array_map('trim', explode(' ',$enrolled_course));

            if (in_array($course_id, $enrolled_courses_array)) {
                $enrolled = true;
                ?>
                <button class="enroll-btn" onclick="location.href='enroll.php?id=<?php echo $row['id'];?>'">🎓 Enrolled</button>
                <?php
            }

            if($enrolled==false){
        ?>

        <button class="enroll-btn" onclick="location.href='enroll.php?id=<?php echo $row['id'];?>'">🎓 Enroll for Free</button>
         <?php }}?>
       

        <div class="course-section">
            <h2>🛠 Skills You Will Learn</h2>
            <p><?php echo $row["skills"]; ?></p>
        </div>

        <div class="course-section">
            <h2>📘 About This Course</h2>
            <p><?php echo $row["about"]; ?></p>
        </div>
       
    </div>
</div>
