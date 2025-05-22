<?php
include "../config.php";
include "header.php";

$id = $_GET['id'];
$sql = "DELETE from reviews where id='$id'";
$result = $conn->query($sql);
if ($result) {
    header("Location: ../index.php");
} else {
    echo "<script>alert('Error removing review');</script>";
}


?>