<?php 
include "header.php"; 
include "config.php";


if(isset($_GET['quiz_id'])){
$quiz_id = $_GET['quiz_id'] ?? null;
$sql= "SELECT total_points, passing_marks from quiz where id= '$quiz_id'";
$result= $conn->query($sql);
$row= $result->fetch_assoc();
$total_points= $row['total_points'];
$passing_marks= $row['passing_marks'];}

$total_points_earned = $_GET['total_points_earned']??0; 


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
        }

        if(isset($_GET['chapter_num'])){
            $chapter_num= $_GET['chapter_num'];
            $new_chapter_num= $chapter_num-1;
            $course_id = $_GET['id'];
            $sql = "SELECT id FROM chapters WHERE Chapter_number = $new_chapter_num AND course_id = $course_id";
           
            $result = $conn->query($sql);
            $row = $result->fetch_assoc();
            $chapter_id= $row['id'];

            // $username = $_SESSION['name'];
            $user_id=$_SESSION['user_id'];
            
            $sql= "SELECT completed_chapters from enrolled WHERE user_id='$user_id'";
            $result= $conn->query($sql);
            $row=$result->fetch_assoc();
            $completed_chapters =$row['completed_chapters'] ?? '';


            $completed_chapters_array= explode(separator: ' ',string: $completed_chapters);

            if (!in_array($chapter_id, $completed_chapters_array)) {

                $completed_chapters= "$completed_chapters"." $chapter_id"; 
                $sql = "UPDATE enrolled SET completed_chapters = '$completed_chapters' WHERE user_id = '$user_id'";
                if ($conn->query($sql)) {
                
                    $sql= "SELECT * from chapters where id=$chapter_id";
                    $results=$conn->query($sql);    
                    $rows=$results->fetch_assoc();
                    $course_id = $rows['course_id'];
                

                    header("Location: enroll.php?id=$course_id&chapter_num=$chapter_num ");
                    exit;
                } 

}}
else{
    $chapter_num= 1;
}


if (isset($_GET['id'])) {
    $course_id = $_GET['id'];
    $question_num = isset($_GET['question_num']) ? $_GET['question_num'] : 1;

    $sql = "SELECT * FROM course WHERE id = $course_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $course_name = $row['course_name'];
    $user_id=$_SESSION['user_id'];
    
    $select_sql= "SELECT user_id from enrolled WHERE user_id= '$user_id'";
    $select_result=$conn->query($select_sql);
    $select_row=$select_result->fetch_assoc();
    
    $check_sql = "SELECT * FROM enrolled WHERE user_id = '$user_id'";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows == 0) {
    $insert_sql="INSERT into enrolled (user_id) VALUE ('$user_id')";
    $conn->query($insert_sql);}

    $sql = "SELECT enrolled_courses, completed_chapters FROM enrolled WHERE user_id= '$user_id'";
    $result = $conn->query($sql);
    $rows = $result->fetch_assoc();
    $enrolled_course_id = trim($rows['enrolled_courses'] ?? '');
 
    $completed_chapters = trim($rows['completed_chapters'] ?? '');

    $enrolled_courses_array = array_map('trim', explode(' ', $enrolled_course_id));
    $completed_chapters_array = array_map('trim', explode(' ', $completed_chapters));

    if (!in_array($course_id, $enrolled_courses_array)) {
        $enrolled_course_id = trim("$enrolled_course_id $course_id");
        $update_sql = "UPDATE enrolled SET enrolled_courses = '$enrolled_course_id' WHERE user_id = '$user_id'";
       
        if($conn->query($update_sql)){
            // echo "updated";
            // echo $user_id;
            // echo $enrolled_course;
        }
    }

    $chaptersql = "SELECT * FROM chapters WHERE course_id = $course_id";
    $chapter_result = $conn->query($chaptersql);
}
?>

<div class="background">
    <div class="course-content">
        <div class="course-name">
            <div class="course-name-left">
                <img width="100px" src="img/php.jpeg" alt="PHP Course Logo">
            </div>
            <div class="course-name-right">
                <h1><?php echo $row["course_name"]; ?></h1>
            </div>
        </div>

        <div class="start-course">
            <div class="course-nav">
                <h3>Start Learning</h3>
                <ul>
                <?php
                $chapter_sidebar_result = $conn->query("SELECT * FROM chapters WHERE course_id = $course_id");
                while ($chapter_row = $chapter_sidebar_result->fetch_assoc()) {
                    $title = $chapter_row['chapter_name'];
                    $chapter_id = $chapter_row['id']; 
                    $chapter_number = $chapter_row['Chapter_number'];
                    $checked = in_array($chapter_id, $completed_chapters_array) ? "checked" : "";
                ?>


                    <li style="list-style:none; margin-bottom:10px;">
                        <a href="enroll.php?id=<?php echo $course_id; ?>&chapter_id=<?php echo $chapter_id; ?>" style="text-decoration:none; color:black; display:flex; align-items:center;">

                            <input class="checks" type="checkbox"  style="margin-right:10px;" <?php echo $checked;?>>
                            <span><?php echo $title; ?></span>
                            <?php if ($_SESSION['role'] == 'admin') { ?>
                                <button onclick="window.location.href='admin/remove_chapters.php?id=<?php echo $chapter_id; ?>'" style="margin-left:auto;" class="delete-btn">Delete</button>
                            <?php } ?>
                        </a>
                    </li>
                <?php } ?>
                

                    

                    <li style="background-color:white;">
                        <div id="completion-message"  >
                            <!-- <p>🎉 Congrats! You’ve completed all chapters.</p> -->
                             <?php
                             $quiz_sql= "SELECT id, quiz_name from quiz where course_id = $course_id";
                             $quiz_result = $conn->query($quiz_sql);
                            //  $quiz_row= $quiz_result->fetch_assoc();
                            //  echo $course_id."<br>";
                             
                             while ($quiz_row = $quiz_result->fetch_assoc()) {
                                $quiz_id= $quiz_row["id"];    
                                $quiz_name= $quiz_row["quiz_name"]?> 
                        
                                <form action='enroll.php' method='GET'>
                                <input type='hidden' name='quiz_id' value='<?php echo $quiz_id; ?>'>
                                <input type='hidden' name='id' value='<?php echo $course_id;?>'>
                                <li style="display: flex; align-items: center;">
                                <input type="checkbox" name="quiz_done" id="" 
                                
                                <?php 
                                    $check_result="SELECT * from quiz_result where user_id= $user_id and quiz_id= $quiz_id and course_id= $course_id";
                                    $check_result= $conn->query($check_result);
                                    if($check_result->num_rows>0){
                                        echo "checked";
                                      }
                                     
                                    
                                   
                                
                                ?>>
                                <input type="submit" value="<?php echo $quiz_name; ?>" name="quiz">
                                <?php
                                $all_quiz_sql= "SELECT * from quiz_result where user_id= $user_id AND course_id= $course_id";
                                $all_quiz_result= $conn->query($all_quiz_sql);
                                // echo $all_quiz_result->num_rows;
                               

                                 ?>
                                <?php if ($_SESSION['role'] == 'admin') { ?>
                                   
                                <input type="button" value="Remove"
                                    onclick="window.location.href='admin/remove_quiz.php?id=<?php echo $quiz_id; ?>'"
                                    style="margin-left: auto;" class="delete-btn">

                            
                                <?php } ?>
                                 </li></form> 
                               
                            </form>
                            
                            
                                    
                               <?php }
                            
                             ?>
                              

                          
                            <br>
                            <?php if ($_SESSION['role'] == 'admin') { ?>
                                <a href="admin/create_quiz.php?id=<?php echo $course_id; ?>"><button class="remove-btn">Add Quiz</button></a>
                            <?php } ?>
                        </div>
                    </li>
                    <?php  
        //  echo $all_quiz_result->num_rows;
        //  echo $quiz_result->num_rows;
         
                    if (isset($all_quiz_result) && $all_quiz_result->num_rows == $quiz_result->num_rows) {
                       
                    
                        ?>

                                  <p>
                                    
                             <a href="certificate.php?id=<?php echo $course_id ?>">
                                <button class="quiz_end_button">Download Certificate</button>
                            </a> 
                            <?php } ?>
                </ul>
               
            </div>

            <div class="course-data">
                
            <?php 
             if (!isset($_GET['quiz'])){
                if(isset($_GET['chapter_id'])){
                    $chapter_id= $_GET['chapter_id'];
                    // echo $chapter_id;
                    
                $sql= "SELECT Chapter_number from chapters WHERE id= $chapter_id";
                $result=$conn->query($sql);
                $row=$result->fetch_assoc();
                $chapter_num= $row['Chapter_number'];

                }
                
            
            $sql= "SELECT * from chapters where course_id =$course_id && Chapter_number=$chapter_num";
            if($result=$conn->query($sql))
            $row_count = $result->num_rows;
            if($row_count>0){
            {
            
                $row = $result->fetch_assoc();
              
               
                echo "<h2 id='video-title'>".$row['chapter_name']."</h2>";?>

               
            <div id="video-area" style="margin-bottom: 30px;">
            <iframe 
                id="videoFrame" 
                width="100%" 
                height="400"  
                src="<?php echo $row['link'] . '&autoplay=1&mute=1'; ?>" 
                allow="autoplay; encrypted-media" 
                allowfullscreen>
            </iframe>

            </div>
            
    <?php
            
                $chapter_num=$chapter_num+1;

       
                
?>
                <form action='enroll.php' method='GET'>
                    <input type='hidden' name='id' value='<?php echo $course_id?>'>
                    <input type="hidden" name="chapter_num" value='<?php echo $chapter_num?>'>
                    <input type="submit"  value="NEXT">
               </a></form>
           <?php }}
        else{

            echo "<div id='completion-message'  style= 'color: green; font-weight: bold; margin-top: 20px;'>Congrats you completed all chapters</div>";
               
        }}?>

               

                <!-- Main Content Area -->
                <div id="content-area">
                <?php
                if (isset($_GET['quiz'])) {
                   
$quiz_id = (int) $_GET['quiz_id'];
$question_num = isset($_GET['question_num']) ? $_GET['question_num'] : 1;
if (isset($_GET['quiz']) ) {

    $check_result="SELECT * from quiz_result where user_id= $user_id and quiz_id= $quiz_id";
    $check_result= $conn->query($check_result);
    if($check_result->num_rows>0){
        echo "<p><b>Quiz completed!</b></p>";
      }
    else{

    $sql_ques = "SELECT * from questions where quiz_id = $quiz_id";
    $result_ques = $conn->query($sql_ques);
    $total_questions = $result_ques->num_rows;
    echo "Total questions: ".$total_questions." | Maximum Marks: ".$total_points;
    if($total_questions==0){
        echo "<br>No questions available";
        
    }else{
    $each_question_points = $total_points / $total_questions;}
    

    $sql_quiz = "SELECT * from questions where quiz_id = $quiz_id and question_num = $question_num";
    $result_quiz = $conn->query($sql_quiz);
    $row_quiz = $result_quiz->fetch_assoc();
    $question_id = $row_quiz['id']?? '';

    if ($row_quiz) {
?>
        <h1>QUIZ</h1>
        <?php if($_SESSION['role']=='admin'){ ?>

        <a href="admin/quiz.php?id=<?php echo $quiz_id; ?>"><button class="remove-btn" style="margin-left:500px;">Add questions</button></a>


        <br><br><a href="admin/remove_question.php?id=<?php echo $question_id; ?>"><button class="remove-btn" style="margin-left:500px;">Remove</button></a>

        <a href="admin/edit_question.php?id=<?php echo $question_id; ?>"><button class="remove-btn" >Edit</button></a>
        <?php } ?>
        <form action="enroll.php" method="GET"><br><br>
            <p>
                <strong>Q<?php echo $question_num; ?>:</strong> <?php echo $row_quiz['question']; ?><br><br>
                <?php
                $sql_ans = "SELECT * from answers where question_id = $question_id";
                $result_answers = $conn->query($sql_ans);
                while ($row_answers = $result_answers->fetch_assoc()) {
                    $value = $row_answers['id'];
                ?>
                    <label><input type='radio' value='<?php echo $value; ?>' name='options'
                    <?php if (isset($_GET['options'])) echo 'disabled';  
                    if (isset($_GET['options']) && $_GET['options'] == $value) echo ' checked'; ?>
                    
                    required> <?php echo htmlspecialchars($row_answers['option']); ?></label><br>
                <?php } ?>
                
                <input type='hidden' name='quiz_id' value='<?php echo $quiz_id; ?>'>
                <input type="hidden" name="id" value="<?php echo $course_id;?>">
                <input type='hidden' name='quiz' value='1'>
                <input type='hidden' name='total_points_earned' value='<?php echo $total_points_earned; ?>'> 
                <br>
                <input type='hidden' name='question_num' value='<?php echo $question_num; ?>'>
                <br>
                <input type='submit' value='Submit'>
            </p>
        </form>

        <?php
        
        if (isset($_GET['options'])) {
            $option_id = $_GET['options'];
            if (is_numeric($option_id)) {
                $selected_sql = "SELECT * FROM answers WHERE id = $option_id";
                $selected_result = $conn->query($selected_sql);
                $selected_row = $selected_result->fetch_assoc();

                if ($selected_row && $selected_row['is_correct'] == 1) {
                    echo "<p style='color:green'><b>✅ Correct Answer!</b></p>";
                    $points_earned = $each_question_points;
                   
                    // echo "Points earned: ".$points_earned."<br>";
                    
                   
                    $total_points_earned = $total_points_earned + $points_earned;
                    // echo "total points earned".$total_points_earned;
                   
                    $next_question = $question_num + 1;
                    
                    if ($next_question <= $total_questions) {
                        ?>
                        <form action='enroll.php' method='GET'>
                            <input type='hidden' name='quiz_id' value='<?php echo $quiz_id ?>'>
                            <input type='hidden' name='id' value='<?php echo $course_id?>'>
                            <input type='hidden' name='quiz' value='1'>
                            <input type="hidden" name="total_points_earned" value="<?php echo $total_points_earned; ?>">
                            <input type='hidden' name='question_num' value='<?php echo $next_question; ?>'>
                            <input type='submit' value='Next' style='margin-left:650px; margin-top: -80px; position:absolute;'>
                        </form>
                        <?php
                    } else {
                        echo "<p style='color:blue'><b>🎉 Quiz Completed!</b></p>"; ?>
                        <p>SCORE</p>

                        <?php echo $total_points_earned; ?> out of <?php echo $total_points;?><br> 
                        <?php if($total_points_earned>= $passing_marks){
                            echo "<p style='color:green'><b>✅ You have passed the quiz!</b></p>";
                                $insert_result="INSERT into quiz_result (user_id, quiz_id, course_id, score) VALUE ('$user_id', '$quiz_id','$course_id', '$total_points_earned')";
                                $conn->query($insert_result);
                                echo "<a href='enroll.php?id=$course_id'<input type= 'submit' value='Back to Chapters' >Back to Chapters</button>";
                                
                        }else{
                            echo "<p style='color:red'><b>❌ You have failed the quiz!</b></p>";
                        }?>
                        <br><br>
                       
                            
                    <?php }
                
                } else {
                    echo "<p style='color:red'><b>❌ Wrong Answer</b></p>";
                   
                    $points_earned = 0;
                   
                    // echo "Points earned: ".$points_earned."<br>";
                    
                   
                    $total_points_earned = $total_points_earned + $points_earned;
                    // echo "total points earned".$total_points_earned;
                   
                    $next_question = $question_num + 1;
                    // echo "Next question is ".$next_question;
                    if ($next_question <= $total_questions) {
                        ?>
                        <form action='enroll.php' method='GET'>
                            <input type='hidden' name='quiz_id' value='<?php echo $quiz_id ?>'>
                            <input type='hidden' name='id' value='<?php echo $course_id?>'>
                            <input type='hidden' name='quiz' value='1'>
                            <input type="hidden" name="total_points_earned" value="<?php echo $total_points_earned; ?>">
                            <input type='hidden' name='question_num' value='<?php echo $next_question; ?>'>
                            <input type='submit' value='Next' style='margin-left:650px; margin-top: -80px; position:absolute;'>
                        </form>
                        <?php
                    } else {?>

                        

                        <p>SCORE</p>

                        <?php echo $total_points_earned; ?> out of <?php echo $total_points; ?><br>   
                        <?php if($total_points_earned>= $passing_marks){
                            echo "<p style='color:green'><b>✅ You have passed the quiz!</b></p>";
                            $insert_result="INSERT into quiz_result (user_id, quiz_id, course_id, score) VALUE ('$user_id', '$quiz_id','$course_id', '$total_points_earned')";
                            $conn->query($insert_result);
                            echo "<a href='enroll.php?id=$course_id'<input type= 'submit' value='Back to Chapters' >Back to Chapters</button>";
                            
                           
                        }else{
                            echo "<p style='color:red'><b>❌ You have failed the quiz!</b></p>";?>
                            <p>
                            <a href="enroll.php?id=<?php echo $course_id ?>&quiz=1&quiz_id=<?php echo $quiz_id ?>">
                                    <button class="quiz_end_button">Try Again</button>
                                </a> 
                                
                            </p>
                        <?php }?>                     
                         <br><br>
                       
                    <?php }
                    
                


                }
            }
        }
    } else {
        echo "<p><b>Quiz completed!</b></p>";
        if($_SESSION['role']=='admin'){
            echo "<a href='admin/quiz.php?id=$quiz_id'><button class='remove-btn' style='margin-left:500px;'>Add questions</button></a>";
        }
    }
}}}?>


            <?php if ($_SESSION['role'] == 'admin') {
                echo "<a href='admin/add_chapters.php?id=" . $course_id . "'><input type='button' class='admin-btn' style='position:absolute; top:120px; right:50px;' value='Add Chapters'></a>";
            }?>
        </div>
    </div>
   
</div>



