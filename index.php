<?php
include "header.php";
include "config.php";

?>

<section class="index-container">
    <div class="index-container-left">
        <h1><span>Upgrade</span><br><span>Your Career</span></h1>
    </div>
    <div class="index-container-right">
        <img src="img/career.jpeg" alt="Career Upgrade Image">
    </div>
</section>

<section class="index-courses" id="courses">
    <h2 class="course-heading">Courses We Offer</h2>
    <div class="index-container-courses">
        <?php
        $sql = "SELECT * FROM course WHERE deleted_at IS NULL";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            ?>
                <div onclick="location.href='course_intro.php?id=<?php echo $row['id']; ?>'" class="box">
                    <img src='uploads/<?php echo $row['image']; ?>' alt="<?php echo $row['course_name']; ?> Image">
                    <p class='caption'>
                        <?php echo $row['course_name']; ?>
                        <?php if ($_SESSION['role'] == 'admin') { ?>
                            <a href="remove_course.php?id=<?php echo $row['id']; ?>">
                                <input class="remove-btn" type="button" value="Remove">
                            </a>
                        <?php } ?>
                    </p>
                </div>
            <?php
            }
            
    
        ?>
    </div>
    <?php if($_SESSION['role']=='admin')  {
        echo "<a href='admin/add_courses.php'><input type='button' class='admin-btn' value='Add Course'></a>";
        echo "<a href='admin/recover_courses.php'><input type='button' class='admin-btn' style='margin-left:20px;' value='♻ Recover'></a>";
    }?>
</section>

<section class="queries">
    <div class="queries-left">
        <h2>Have any queries?</h2>
        <p>Talk to our team</p>
    </div>
    <div class="queries-right">
        <button onclick="location.href='contact.php'">Contact Us</button>
    </div>
</section>




<?php include "footer.php"; ?>
