<?php
include "config.php";
include "header.php";

$nameErr = $passErr = $emailErr = "";
$validation = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["input_email"];
    $password = $_POST["input_password"];
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

    if (strlen($password) < 8) {
        $passErr = "* Minimum 8 characters required in password";
        $validation = false;
    }

    if ($validation) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password, gender, dob) VALUES ('$name', '$email', '$hashedPassword', '$gender', '$dob')";
        if ($conn->query($sql)) {
           
            
            $sql= "SELECT id from users where email= '$email'";
            $result= $conn->query($sql);
            $row= $result->fetch_assoc();
            $id= $row['id'];


            // $sql= "INSERT INTO role (username, user_id) VALUES ('$name', '$id')";
            // $conn->query($sql);
            header("Location: login.php");
            exit;

        }
    }
}
?>

<div class="signup-wrapper">
    <div class="signup-box">
        <h2>Create Your Account</h2>

        <?php if (!$validation): ?>
            <div class="error-msg">
                <?= $nameErr ?><br>
                <?= $emailErr ?><br>
                <?= $passErr ?><br>
            </div>
        <?php endif; ?>

        <form action="signup.php" method="post" class="signup-form">
            <label for="name">Name</label>
            <input class="signupinput" type="text" name="name" required>

            <label for="input_email">Email</label>
            <input class="signupinput" type="email" name="input_email" required>

            <label for="input_password">Password</label>
            <input class="signupinput" type="password" name="input_password" required>

            <label>Gender</label>
            <div class="gender-options">
                <label><input type="radio" name="gender" value="Male"> Male</label>
                <label><input type="radio" name="gender" value="Female"> Female</label>
            </div>

            <label for="dob">Date of Birth</label>
            <input class="signupinput" type="date" name="dob" required>

            <input class="signup-submit" type="submit" value="Sign Up">

            <p class="login-link">Already have an account? <a href="login.php">Login</a></p>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>
