<?php
include "../config.php";
include "header.php";

// Handle reply submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reply']) && isset($_POST['id'])) {
    $reply = $_POST['reply'];
    $id = $_POST['id'];

    $sql = "UPDATE feedback SET reply = '$reply' WHERE id = $id";
    $conn->query($sql);
}

$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);
?>

<table class="feedback-table" border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th class="feedback-header">ID</th>
        <th class="feedback-header">Name</th>
        <th class="feedback-header">Email</th>
        <th class="feedback-header">Contact</th>
        <th class="feedback-header">Query/Feedback</th>
        <th class="feedback-header">Reply</th>
        <th class="feedback-header">Send</th>
    </tr>

    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr class="feedback-row">
            <td class="feedback-cell"><?php echo $row['id']; ?></td>
            <td class="feedback-cell"><?php echo $row['name']; ?></td>
            <td class="feedback-cell"><?php echo $row['email']; ?></td>
            <td class="feedback-cell"><?php echo $row['contact']; ?></td>
            <td class="feedback-cell"><?php echo $row['query']; ?></td>
            <td class="feedback-cell">
                <form action="messages.php" method="POST" class="feedback-form">
                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <input class="feedback-input" type="text" name="reply" value="<?php echo $row['reply']; ?>">
            </td>
            <?php if(empty($row['reply'])){ ?>
            <td class="feedback-cell">
                    <input class="feedback-submit" type="submit" value="Send">
                </form>
            </td>
            <?php } else{?>
                <td class="feedback-cell">
                    <input class="feedback-submit" type="submit" value="Sent" style= "background-color:yellow; color:black;">
                </form>
            </td>
            <?php }?>
        </tr>
    <?php } ?>
</table>
