<?php
include 'header.php';
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name=$_POST['reviewer_name'];
    $image=$_POST['reviewer_image'];
    $review_text=$_POST['review_text'];
    $file_name = $_FILES['reviewer_image']['name'];
    $tmp_name = $_FILES['reviewer_image']['tmp_name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);
    $new_name = "img_" . $name . "." . $ext;    
    $destination = "../uploads/" . $new_name;
    $sql = "INSERT INTO reviews (name, image, review) 
        VALUES ('$name', '$new_name', '$review_text')";
        $conn->query($sql);
        if (move_uploaded_file($tmp_name, $destination)) {
            header ("Location: ../index.php");
        } else {
            echo "File upload failed.";
        }

}
?>
<div class="review-form">
    <form action="add_review.php"class="courses-form" method="POST" enctype="multipart/form-data">
        <h2>Add a Review</h2>
        <label for="reviewer_name">Name:</label>
        <input type="text" id="reviewer_name" name="reviewer_name" required>

        <label for="reviewer_image">Name:</label>
        <input type="file" id="reviewer_image" name="reviewer_image" required>

        <label for="review_text">Review:</label>
        <textarea id="review_text" name="review_text" required></textarea>

        <input type="submit" value="Submit Review">
</div>