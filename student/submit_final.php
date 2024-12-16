<?php
session_start();
include("../include/connect.php");

// Check if session data exists
if (!isset($_SESSION['form_data'])) {
    header("Location: form.php");
    exit();
}

$form_data = $_SESSION['form_data'];

// Insert data into the database
$query = "INSERT INTO exam_requests 
          (student_name, department, student_id, session, phone, course_code, course_title, course_credit, year, semester, status, request_date) 
          VALUES 
          ('{$form_data['name']}', '{$form_data['department']}', '{$form_data['student_id']}', '{$form_data['session']}', '{$form_data['phone']}', '{$form_data['course_code']}', '{$form_data['course_title']}', '{$form_data['course_credit']}', '{$form_data['year']}', '{$form_data['semester']}', 'pending', NOW())";

if (mysqli_query($conn, $query)) {
    unset($_SESSION['form_data']); // Clear session data after successful submission
    echo "Request successfully submitted!";
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
