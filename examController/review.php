<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../include/connect.php");

// Check if ID is passed in the URL
if (!isset($_GET['id'])) {
    header("Location: pending.php"); // Redirect if no ID is provided
    exit();
}

$id = $_GET['id'];

// Fetch the specific exam participation request
$request_query = "SELECT * FROM `exam_requests` WHERE id='$id'";
$request_result = mysqli_query($conn, $request_query);

if (mysqli_num_rows($request_result) == 0) {
    header("Location: pending.php"); // Redirect if request not found
    exit();
}

$request_data = mysqli_fetch_assoc($request_result);

if (isset($_POST['approve'])) {
    // Update the request to sent
    $update_query = "UPDATE `exam_requests` 
                     SET reviewed_by_controller = 1, sent_to_department = 'sent' 
                     WHERE id='$id'";
    mysqli_query($conn, $update_query);

    $_SESSION['success'] = "Request sent successfully.";
    header("Location: pending.php"); // Redirect back to pending lists
    exit();
}

if (isset($_POST['reject'])) {
    // Update the request to rejected
    $update_query = "UPDATE `exam_requests` 
                     SET reviewed_by_controller = 1, sent_to_department = 'rejected' 
                     WHERE id='$id'";
    mysqli_query($conn, $update_query);

    $_SESSION['error'] = "Request rejected successfully.";
    header("Location: pending.php"); // Redirect back to pending lists
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review Exam Participation Request</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Review Exam Participation Request</h1>

        <div class="card mt-3">
            <div class="card-body">
                <h5>Student Name: <?php echo $request_data['student_name']; ?></h5>
                <p><strong>Department:</strong> <?php echo $request_data['department']; ?></p>
                <p><strong>Student ID:</strong> <?php echo $request_data['student_id']; ?></p>
                <p><strong>Session:</strong> <?php echo $request_data['session']; ?></p>
                <p><strong>Course Code:</strong> <?php echo $request_data['course_code']; ?></p>
                <p><strong>Course Title:</strong> <?php echo $request_data['course_title']; ?></p>
                <p><strong>Year:</strong> <?php echo $request_data['year']; ?></p>
                <p><strong>Semester:</strong> <?php echo $request_data['semester']; ?></p>
                <p><strong>Request Date:</strong> <?php echo $request_data['request_date']; ?></p>

                <form method="post">
                    <button type="submit" name="approve" class="btn btn-success">Approve</button>
                    <button type="submit" name="reject" class="btn btn-danger">Reject</button>
                </form>
            </div>
        </div>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success mt-3">
                <?php
                echo $_SESSION['success'];
                unset($_SESSION['success']);
                ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger mt-3">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
