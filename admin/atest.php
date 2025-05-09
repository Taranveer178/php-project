<?php

class Chapter{
    
    public function getFirstChapterByCourseId($course_id){
        global $conn;
        $sql ="SELECT * FROM chapters WHERE course_id = $course_id AND deleted_at IS NULL ORDER BY id ASC LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    
    public function getChapterById($chapter_id){
        global $conn;
        $sql ="SELECT * FROM chapters WHERE id = $chapter_id AND deleted_at IS NULL";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    
}



    

?>
