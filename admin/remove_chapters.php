<?php
include "../config.php";
include "header.php";

// -----------------------------
// Handle recover/delete actions first
// -----------------------------
if (isset($_GET['action']) && isset($_GET['chapter_id']) && isset($_GET['course_id'])) {
   
    $chapter_id = $_GET['chapter_id'];
    $select_sql = "SELECT Chapter_number FROM chapters WHERE id = $chapter_id";
    $result = $conn->query($select_sql);
    $row = $result->fetch_assoc();
    $chapter_num = $row['Chapter_number'];
    $course_id = $_GET['course_id'];
    $action = $_GET['action'];

    if ($action === 'recover') {
        $sql = "UPDATE chapters SET deleted_at = NULL WHERE id = $chapter_id";
    } elseif ($action === 'delete') {
        $sql = "DELETE FROM chapters WHERE id = $chapter_id";

        $update_sql = "UPDATE chapters SET Chapter_number = Chapter_number - 1 WHERE course_id = $course_id AND Chapter_number > $chapter_num";
        if ($conn->query($update_sql) === FALSE) {
            echo "<p>Error updating chapter numbers: " . $conn->error . "</p>";
            exit;
        }

    }

    if (isset($sql) && $conn->query($sql)) {
        header("Location: remove_chapters.php?course_id=$course_id");
        exit;
    } else {
        echo "<p>Error processing action: " . $conn->error . "</p>";
        exit;
    }
}

// -----------------------------
// Soft Delete (from button click)
// -----------------------------
if (isset($_GET['id'])) {
    $chapter_id = $_GET['id'];
    $sql = "SELECT * FROM chapters WHERE id = $chapter_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $course_id = $row['course_id'];

    $sql = "UPDATE chapters SET deleted_at = NOW() WHERE id = $chapter_id";
    if ($conn->query($sql)) {
        header("Location: ../enroll.php?id=$course_id");
        exit;
    } else {
        echo "Error deleting chapter";
    }
}

// 
// Display deleted chapters
//
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    $sql = "SELECT * FROM chapters WHERE course_id = $course_id AND deleted_at IS NOT NULL";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<h2><center>Recover Chapters</center></h2>";
        echo "<table border='1' class='table_data'>";
        echo "<tr>
                <th>Chapter Name</th>
                <th>Recover</th>
                <th>Delete Permanently</th>
              </tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['chapter_name']) . "</td>";
            echo "<td><a href='remove_chapters.php?action=recover&chapter_id=" . $row['id'] . "&course_id=$course_id'>Recover</a></td>";
            echo "<td><a href='remove_chapters.php?action=delete&chapter_id=" . $row['id'] . "&course_id=$course_id' onclick=\"return confirm('Are you sure you want to permanently delete this chapter?')\">Delete</a></td>";
            echo "</tr>";
        }
        echo "</table>
         <a href=../enroll.php?id=".$course_id." <button>Go Back</button>";
    } else {
        echo "<p>No deleted chapters to recover.</p>
         <a href=../enroll.php?id=".$course_id." <button>Go Back</button>";
    
    }
}
?>
