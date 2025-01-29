<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../include/connect.php");

$dept = $_SESSION['dept'];

if (isset($_POST['send_to_controller'])) {
    // Fetch exam requests for the department only with status 'Pending'
    $exam_requests_query = "SELECT * FROM `exam_requests` 
        
                            WHERE department='$dept' 
                            AND status = 'pending'";
    $exam_requests_result = mysqli_query($conn, $exam_requests_query);
    
    // Check if there are any exam requests to send
    if (mysqli_num_rows($exam_requests_result) > 0) {
        while ($row = mysqli_fetch_assoc($exam_requests_result)) {
            // Prepare and insert each record into the exam_participation_list table for the controller to view
            $student_name = mysqli_real_escape_string($conn, $row['student_name']);
            $student_id = mysqli_real_escape_string($conn, $row['student_id']);
            $session = mysqli_real_escape_string($conn, $row['session']);
            $phone = mysqli_real_escape_string($conn, $row['phone']);
            $course_code = mysqli_real_escape_string($conn, $row['course_code']);
            $course_title = mysqli_real_escape_string($conn, $row['course_title']);
            $course_credit = mysqli_real_escape_string($conn, $row['course_credit']);
            $year = mysqli_real_escape_string($conn, $row['year']);
            $semester = mysqli_real_escape_string($conn, $row['semester']);
          //  $status = mysqli_real_escape_string($conn, $row['status']);
            $request_date = mysqli_real_escape_string($conn, $row['request_date']);

            // Insert into exam_participation_list
            $insert_query = "INSERT INTO `exam_participation_list` 
                             (`department`, `student_name`, `student_id`, `session`, `phone`, `course_code`, 
                              `course_title`, `course_credit`, `year`, `semester`, `status`, `request_date`) 
                             VALUES 
                             ('$dept', '$student_name', '$student_id', '$session', '$phone', '$course_code', 
                              '$course_title', '$course_credit', '$year', '$semester', 'pending', '$request_date')";
            
            mysqli_query($conn, $insert_query);

            // Update the status of the record in exam_requests
            $update_status_query = "UPDATE `exam_requests` 
                                    SET `status` = 'Sent' 
                                    WHERE `student_id` = '$student_id' 
                                    AND `course_code` = '$course_code' 
                                    AND `status` = 'Pending'";
            
            mysqli_query($conn, $update_status_query);
        }

        // Redirect back to the department dashboard with a success message
        $_SESSION['success'] = "Exam participation list successfully sent to the Exam Controller.";
    } else {
        // If no records were found
        $_SESSION['error'] = "No pending exam requests to send.";
    }

    // Redirect to the department dashboard
   // header("Location: index.php");
    exit();
}
?>
