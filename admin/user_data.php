<?php
include "../config.php";
include "header.php";
if (!$conn){
    die("Connection failed");
}
echo "<h1>Admin Panel</h1>";
$sql ="SELECT * from users ";
$result=$conn->query($sql);


// $row=$result->fetch_assoc();

 echo 
 "<form action='' method='POST'>
<table class='table_data' border=1>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Gender</th>
        <th>Date of Birth</th>
        <th>Role</th>
        <th>Change Role</th>
        <th>View Progress</th>
        <th>Delete <input type='checkbox' onclick='toggleSelectAll(this)'></th>
    </tr>";
    while($row =$result->fetch_assoc()){
        echo  
                "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["username"]."</td>
                    <td>".$row["email"]."</td>
                    <td>".$row["gender"]."</td>
                    <td>".$row["dob"]."</td>
                    <td>".$row["role"]."</td>
                    <td>";
                    if($row['role']=='admin'){
                        echo "<a href='role.php?id=".$row['id']."' style='text-decoration:none;'><input type='button' class='table-button' value='Remove Admin'></a>";
                    }
                    elseif($row['role']=='user'){
                        echo "<a href='role.php?id=".$row['id']."' style='text-decoration:none;'><input type='button' class='table-button' value='Make Admin'></a>";
                    }
                    echo  "</td>
                    <td><a href='view_progress.php?id=".$row['id']."' style='text-decoration:none;'><input type='button' class='table-button' value='View Progress'></a></td>
                    <td><input type='checkbox' name='delete_ids[]' value='".$row["id"]."'></td>
                </tr>";
                    
    }


    echo "</table>"; 
    echo "<input type='submit' name='delete' class='admin-btn' value='delete'>
    </form>";

    if(isset($_POST["delete"]))
    {
        if(isset($_POST["delete_ids"])){
        $ids_to_delete = implode(",", $_POST["delete_ids"]);
        // $remove_sql= "UPDATE users SET deleted_at= NOW() WHERE id IN ($ids_to_delete)";
        // $conn->query($remove_sql);
         $delete_sql = "DELETE FROM users WHERE id IN ($ids_to_delete)";
         $conn->query($delete_sql);
        }
        
    }
    



?>
    <script>
function toggleSelectAll(source) {
    let checkboxes = document.querySelectorAll('input[name="delete_ids[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = source.checked;
    });
}
</script>



