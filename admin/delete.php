<?php

// include "../config.php";

class Delete{
    
    function soft_delete($table, $id){
        global $conn;
        $sql="UPDATE $table SET deleted_at = NOW() WHERE id = $id";
        $conn->query($sql);
    }

    function delete($table, $id ){
        global $conn; 
        $sql= "DELETE from $table WHERE id= $id";
        $conn->query($sql);
    }


  
}
$delete_obj = new Delete;


if(isset($_GET['remove_id'])){
    $table=$_GET['table'];
    $remove_id=$_GET['remove_id'];
    $delete_obj->soft_delete($table, $remove_id);
}

if(isset($_GET['delete_id'])){
    $table=$_GET['table'];
    $delete_id=$_GET['delete_id'];
    $delete_obj->delete($table, $delete_id);
}


?>