<?php
require('fpdf/fpdf.php'); 
include "config.php";

if (isset($_GET['id'])) {
    $course_id = $_GET['id'];



    session_start();
  
    $course_id = $_GET['id'];
    $username=$_SESSION['name'];
    $sql= "SELECT course_name from course where id=$course_id";
    $result=$conn->query($sql);
    $row=$result->fetch_assoc();
    $course_name=$row['course_name'];

    $pdf = new FPDF();
    $pdf->AddPage();

    // Set font and style
    $pdf->SetFont('Arial','B',16);

    // Certificate title
    $pdf->Cell(0,10,'Certificate of Completion',0,1,'C');
    $pdf->Ln(10);

    // User info
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0,10,"This is to certify that $username has successfully completed the course : $course_name",0,1,'C');

    $pdf->Ln(20);
    $pdf->Cell(0,10,"Date: " . date("d-m-Y"),0,1,'C');

    // Output as a download
    $pdf->Output('D', 'Certificate_'.$username.'.pdf'); // 'D' for download
}
?>
