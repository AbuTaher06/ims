<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start(); 

if (!isset($_SESSION['dept'])) {
    header("Location: ../deptlogin.php");
    ob_end_flush();
    exit();
}

$pageTitle = "Review Request";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch the details of the selected request
$request_query = "SELECT `student_name`, `student_id`, `session`, `phone`, `course_code`, 
                         `course_title`, `course_credit`, `year`, `semester`, `transcript_path`, 
                         `status`, `request_date` 
                  FROM `exam_requests` 
                  WHERE `id` = $id";

$request_result = mysqli_query($conn, $request_query);

if ($request_result && mysqli_num_rows($request_result) > 0) {
    $row = mysqli_fetch_assoc($request_result);
} else {
    $_SESSION['error'] = "No record found for the given ID.";
    header("Location: previous_page.php"); // Redirect to a previous page or error page
    exit();
}

// Handle the send to exam controller action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_to_controller'])) {
    $insert_query = "UPDATE `exam_requests` SET `status` = 'Sent' WHERE `id` = $id";

    if (mysqli_query($conn, $insert_query)) {
        $_SESSION['success'] = "Request sent to exam controller successfully.";
        header("Location: exam_participation_request.php");
        exit();
    } else {
        $_SESSION['error'] = "Error sending request: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Request</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Update with your actual path -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"> <!-- Font Awesome for icons -->
    <style>
        .card {
            background-color: #f8f9fa;
            border: 1px solid #007bff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .card-header {
            background-color: #007bff;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 1rem;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }
    </style>
</head>
<body>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Review Exam Request</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Review</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="container mt-0">
        <div class="card mx-auto" style="max-width: 600px;">
            <div class="card-header">
                <h2 class="text-center">Details of <?php echo htmlspecialchars($row['student_name']); ?>'s Request</h2>
            </div>
            <div class="card-body text-center">
                <div class="text-light bg-dark">
                <h5>Student ID: <?php echo htmlspecialchars($row['student_id']); ?></h5>
                <h5>Session: <?php echo htmlspecialchars($row['session']); ?></h5>
                <h5>Phone: <?php echo htmlspecialchars($row['phone']); ?></h5>
                </div>
                <hr>
                <table class="table table-bordered mt-3">
                    <tbody>
                        <tr>
                            <th>Course Code</th>
                            <td><?php echo htmlspecialchars($row['course_code']); ?></td>
                        </tr>
                        <tr>
                            <th>Course Title</th>
                            <td><?php echo htmlspecialchars($row['course_title']); ?></td>
                        </tr>
                        <tr>
                            <th>Course Credit</th>
                            <td><?php echo htmlspecialchars($row['course_credit']); ?></td>
                        </tr>
                        <tr>
                            <th>Year</th>
                            <td><?php echo htmlspecialchars($row['year']); ?></td>
                        </tr>
                        <tr>
                            <th>Semester</th>
                            <td><?php echo htmlspecialchars($row['semester']); ?></td>
                        </tr>
                        <tr>
                            <th>Request Date</th>
                            <td><?php echo htmlspecialchars($row['request_date']); ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td><?php echo htmlspecialchars($row['status']); ?></td>
                        </tr>
                        <tr>
                            <th>Transcript</th>
                            <td>
                                <?php if (!empty($row['transcript_path'])): ?>
                                    <a href="../student/transcripts/<?php echo basename($row['transcript_path']); ?>" target="_blank">
                                        <i class="fas fa-file-alt"></i> View Transcript
                                    </a>
                                <?php else: ?>
                                    No Transcript Available
                                <?php endif; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <!-- Form to send request to exam controller -->
                <form method="POST">
                    <button type="submit" name="send_to_controller" class="btn btn-primary">
                        <i class="fas fa-paper-plane"></i> Send to Exam Controller
                    </button>
                </form>

                <a href="exam_participation_request.php" class="btn btn-success mt-3">
                    <i class="fas fa-arrow-left"></i> Back
                </a> <!-- Link to go back -->
            </div>
        </div>
    </div>
</main><!-- End #main -->

<script src="path/to/bootstrap.bundle.js"></script> <!-- Update with your actual path -->
</body>
</html>
