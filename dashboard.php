<?php
include "header.php";
include "config.php";

$name = $_SESSION['name'];
$user_id = $_SESSION['user_id'];

// Fetch enrolled course IDs
$enrolled_sql = "SELECT enrolled_courses FROM enrolled WHERE user_id = '$user_id'";
$enrolled_result = $conn->query($enrolled_sql);
$enrolled_row = $enrolled_result->fetch_assoc();
$course_ids_string = $enrolled_row['enrolled_courses'] ?? '';

$enrolled = [];

if (!empty($course_ids_string)) {
    $course_ids_array = explode(' ', $course_ids_string); // split by space
    $course_ids_sql = implode(',', array_map('intval', $course_ids_array)); // ensure safe integers

    $courses_sql = "SELECT course_name FROM course WHERE id IN ($course_ids_sql)";
    $courses_result = $conn->query($courses_sql);

    while ($row = $courses_result->fetch_assoc()) {
        $enrolled[] = $row['course_name'];
    }
}

// Fetch user details
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

$email = $row['email'];
$gender = $row['gender'];
$dob = $row['dob'];

$nameErr = $emailErr = "";
$validation = true;
$edit_mode = isset($_POST['edit_mode']) || isset($_POST['update']);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $name = $_POST["name"];
    $email = $_POST["input_email"];
    $gender = $_POST["gender"] ?? '';
    $dob = $_POST["dob"];

    if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
        $nameErr = "* Only letters and white space allowed in name";
        $validation = false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "* Invalid email format";
        $validation = false;
    }

    if ($validation) {
        $sql = "UPDATE users SET username='$name', email='$email', gender='$gender', dob='$dob' WHERE id='{$_SESSION['user_id']}'";
        if ($conn->query($sql)) {
            $_SESSION['name'] = $name;
            echo "<p style='color:green;'> Profile updated successfully!</p>";
            $edit_mode = false;
        }
    }
}
?>

<div class="profile-container">
    <?php if ($edit_mode) { ?>
        <h2>Edit Profile</h2>
        <form action="dashboard.php" method="POST" class="edit-profile-form">
            <label>Name</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            <span class="error"><?php echo $nameErr; ?></span><br><br>

            <label>Email</label>
            <input type="email" name="input_email" value="<?php echo htmlspecialchars($email); ?>" required>
            <span class="error"><?php echo $emailErr; ?></span><br><br>

            <label>Gender</label><br>
            <label><input type="radio" name="gender" value="Male" <?php if ($gender == 'Male') echo 'checked'; ?>> Male</label>
            <label><input type="radio" name="gender" value="Female" <?php if ($gender == 'Female') echo 'checked'; ?>> Female</label><br><br>

            <label>Date of Birth</label>
            <input type="date" name="dob" value="<?php echo $dob; ?>" required><br><br>

            <input type="submit" name="update" value="Update Profile">
        </form>
    <?php } else { ?>
        <h2>Profile Info</h2>
        <div class="profile-details">
            Name: <?php echo $name ?><br>
            Email: <?php echo $email ?><br>
            Gender: <?php echo $gender ?><br>
            Date of Birth: <?php echo $dob ?><br>
            Enrolled Courses: <?php echo implode(', ', $enrolled); ?><br><br>

            <form action="dashboard.php" method="POST">
                <input type="hidden" name="edit_mode" value="true">
                <input type="submit" class="edit-btn" value="Edit Profile">
            </form>
        </div>
    <?php } ?>
</div>
<br><br>
<h2><center>My Enrolled Courses</center></h2>
<table border="1" cellpadding="10" cellspacing="0" class="enroll-table">
    <tr class="enroll-row">
        <th class='enroll-header'>Course Name</th>
        <th class='enroll-header'>Status</th>
    </tr>

    <?php
    $user_id = $_SESSION['user_id'];

    // Get user's enrolled and completed course IDs
    $sql = "SELECT enrolled_courses, completed FROM enrolled WHERE user_id = '$user_id'";
    $result = $conn->query($sql);

    if ($result && $row = $result->fetch_assoc()) {
        $enrolled_courses = explode(' ', trim($row['enrolled_courses']));
        $completed_courses = explode(' ', trim($row['completed']));

        foreach ($enrolled_courses as $course_id) {
            $course_id = intval($course_id);
            $course_sql = "SELECT course_name FROM course WHERE id = '$course_id'";
            $course_result = $conn->query($course_sql);

            if ($course_result && $course_row = $course_result->fetch_assoc()) {
                $course_name = htmlspecialchars($course_row['course_name']);
                $status = in_array($course_id, $completed_courses) ? "Completed" : "In Progress <a href='enroll.php?id=$course_id'><input type='button' value='Continue'></a>";

                echo "<tr class='enroll-row'>";
                echo "<td class='enroll-cell'>$course_name</td>";
                echo "<td class='enroll-cell'>$status </td>";
                echo "</tr>";
            }
        }
    } else {
        echo "<tr><td colspan='2'>No enrolled courses found.</td></tr>";
    }
    ?>
</table>

<br><br>


<div class="feedback-table-container">
    <h2><center>Queries/Feedbacks Given</center></h2>
    <?php
    $name = $_SESSION['name'];
    $sql = "SELECT * FROM feedback WHERE name = '$name'";
    $result = $conn->query($sql);

    echo "<table class='feedback-table' border='1' cellpadding='10' cellspacing='0'>
    <tr>
        <th class='feedback-header'>Query</th>
        <th class='feedback-header'>Reply</th>
    </tr>";
    if( $result->num_rows == 0) {
        echo "<tr class='feedback-row'><td  class='feedback-cell' colspan='2'>No feedback found.</td></tr>";
    }
    else{
    while ($row = $result->fetch_assoc()) {
        echo "<tr class='feedback-row'>
            <td class='feedback-cell'>" . $row['query'] . "</td>";

        if (empty($row['reply'])) {
            echo "<td class='feedback-cell'><i style='color:red;'>Reply Pending</i></td></tr>";
        } else {
            echo "<td class='feedback-cell'>" . $row['reply'] . "</td></tr>";
        }
    }
    }

    echo "</table>";
    ?>
</div>

<?php include "footer.php"; ?>
