<?php

$myfile = fopen("C:/Users/stara/OneDrive/Desktop/test.txt", "w") or die("Unable to open file!");
// echo fread($myfile, filesize("C:/Users/stara/OneDrive/Desktop/test.txt"));

$txt="Hello";
fwrite($myfile,$txt);
fclose($myfile);
?>
<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}
?>