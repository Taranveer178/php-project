<?php
include "header.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
$name=$_POST['name'];
$email=$_POST['email'];
$contact=$_POST['contact'];
$query= $_POST['query'];

$sql= "INSERT into feedback (name, email, contact, query) VALUES ('$name', '$email', '$contact'
, '$query')";
if($conn->query($sql)){
    echo "Query Submitted";
}
}
?>

<div class="contact-section">
    <h3 class="contact-heading">HAVING ANY QUERY? FEEL FREE TO ASK</h3>
    <form class="contact-form" action="contact.php" method="POST">
        <label for="name">Name:</label>
        <input class="contact-input" type="text" name="name" value="<?php if(isset($_SESSION['name'])){echo $_SESSION['name'];}?>" required><br>

        <label for="email">Email:</label>
        <input class="contact-input" type="email" name="email" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];}?>" required><br>

        <label for="contact">Contact Number:</label>
        <input class="contact-input" type="number" name="contact" required><br>

        <label for="query">Feedback/Query:</label>
        <textarea class="contact-textarea" name="query" rows="4" required></textarea><br>

        <input class="contact-submit" type="submit" value="Submit">
    </form>
</div>
<?php include "footer.php"?>
