<?php
include "header.php";
include "config.php";

if(isset($_POST['search'])) {
    $search = $_POST['search'];
    $sql = "SELECT * FROM course WHERE course_name LIKE '%$search%' AND deleted_at IS NULL";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            header("Location: course_intro.php?id=" . $row['id']);
            exit();
        }}}
          
                        
                       


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
    <form class="search-form" action="index.php" method="POST">
        <input type="text" name="search" id="" placeholder="Search for courses" class="search-bar">
        <input type="submit" value="Search" class="search-btn">
    </form>
    <br>
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
<br><br>
<section>
    <div class="review">
        <h2>What Our Students Say</h2>
        <div class="review-container">

        <div >
            <button class="review_arrow" onclick="prevReviews()"><img src="img/left_arrow.png" alt=""></button>
        </div>

            <?php
            $sql = "SELECT * FROM reviews ";
            $result = $conn->query($sql);
            $index = 0;
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="review-box">
                    <div class="review-box-up">
                    <img src='uploads/<?php echo $row['image']; ?>' alt="<?php echo $row['name']; ?> Image">
                    <p>"<?php echo $row['review']; ?>"</p>
                    <h3>- <?php echo $row['name']; ?></h3>
                    </div>
                    <div class="review_box-down">
                  
                     <?php if ($_SESSION['role'] == 'admin') { ?>
                            <a href="admin/remove_review.php?id=<?php echo $row['id']; ?>">
                                <input class="remove-btn" type="button" value="Remove">
                            </a>
                        <?php } ?>
                     </div>
                </div>
               
                <?php  $index++; } 
            ?>
        <div >
             <button class="review_arrow" onclick="nextReviews()"><img src="img/right_arrow.png" alt=""></button>
        </div>

        </div>
            <?php if($_SESSION['role'] =='admin'){
                echo "<a href='admin/add_review.php'><input type='button' class='admin-btn' value='Add Review'></a>";
            }?>
        
    </div>
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

<script>
    let currentPage = 0;
    const reviewsPerPage = 3;

    function showReviews() {
        const boxes = document.querySelectorAll('.review-box');
        const total = boxes.length;

        boxes.forEach((box, index) => {
            box.classList.remove('active');
            if (index >= currentPage * reviewsPerPage && index < (currentPage + 1) * reviewsPerPage) {
                box.classList.add('active');
            }
        });
    }

    function nextReviews() {
        const boxes = document.querySelectorAll('.review-box');
        const total = boxes.length;
        const totalPages = Math.ceil(total / reviewsPerPage);

        if (currentPage + 1 < totalPages) {
            currentPage++;
        } else {
            currentPage = 0; // Wrap to first page
        }
        showReviews();
    }

    function prevReviews() {
        const boxes = document.querySelectorAll('.review-box');
        const total = boxes.length;
        const totalPages = Math.ceil(total / reviewsPerPage);

        if (currentPage > 0) {
            currentPage--;
        } else {
            currentPage = totalPages - 1; // Wrap to last page
        }
        showReviews();
    }

    // Initialize on page load
    window.onload = showReviews;
</script>



<?php include "footer.php"; ?>
