<?php
include "config.php";
include "header.php";

if (!$conn) {
    die("Connection Failed");
}

$error = $emailerror = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['input_email'];
    $entered_password = $_POST['input_password'];

    if (isset($_POST['remember'])) {
        setcookie("email", $email, time() + (86400 * 30), "/");
        setcookie("password", $entered_password, time() + (86400 * 30), "/");
    
    }

    $sql = "SELECT username, password, id FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($row = $result->fetch_assoc()) {
        $password = $row['password'];
        // echo $entered_password;
        // echo "<br>";
        // echo $password;
       if (password_verify($entered_password, $password)) {
            // session_start();
            $_SESSION['name'] = $row['username'];
            $_SESSION['email']=$email;
            $_SESSION['user_id']=$row['id'];
            header("Location:index.php");
        } else {
            $error = true;
        }
    } else {
        $emailerror = true;
    }
}
?>

<div class="login-page">
    <div class="login-box">
        <h2>Login to Your Account</h2>

        <?php if ($error): ?>
            <p class="error-msg">Incorrect Password. Please try again.</p>
        <?php elseif ($emailerror): ?>
            <p class="error-msg">Incorrect Email. Please try again.</p>
        <?php endif; ?>

        <form action="login.php" method="post" class="login-form">
            <label for="email">Email</label>
            <input type="email" name="input_email" id="email" placeholder="Enter your email"
                value="<?php echo isset($_COOKIE['email']) ? $_COOKIE['email'] : ''; ?>" required>

            <label for="password">Password</label>
            <input type="password" name="input_password" id="password" placeholder="Enter your password"
                value="<?php echo isset($_COOKIE['password']) ? $_COOKIE['password'] : ''; ?>" required>

            <div class="remember-box">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember">Remember me</label>
            </div>

            <button type="submit" class="btn primary">Login</button>
            <a href="signup.php" class="btn secondary">Signup</a>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>
