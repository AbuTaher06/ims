<?php
session_start();
ob_start(); 

if (!isset($_SESSION['dept'])) {
    header("Location: ../deptlogin.php");
    ob_end_flush();
    exit();
}

$pageTitle = "Approved Participation List";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");

// Get department from session
$dept = $_SESSION['dept'];

// Fetch participation list with status 'Approved' for the current department
$approved_list_query = "SELECT `id`, `student_name`, `student_id`, `session`, `phone`, `course_code`, `course_title`, 
                        `course_credit`, `year`, `semester`, `status`, `request_date`
                        FROM `exam_participation_list`
                        WHERE `department` = '$dept' AND `status` = 'Approved'";

// Execute query
$approved_list_result = mysqli_query($conn, $approved_list_query);

// Initialize message variable
$message = '';

// Handle the "Send All as Notice" button click (POST request)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['send_notice'])) {
    // Fetch all the IDs of the approved requests
    $query = "SELECT `id` FROM `exam_participation_list` WHERE `department` = '$dept' AND `status` = 'Approved'";
    $result = mysqli_query($conn, $query);
    
    // Flag for success
    $success = true;

    // Insert each ID into the notices table
    while ($row = mysqli_fetch_assoc($result)) {
        $participation_id = $row['id'];
        $notice_query = "INSERT INTO `notices` (participation_id, notice_date) 
                         VALUES ('$participation_id', NOW())";
        if (!mysqli_query($conn, $notice_query)) {
            // If any insert fails, set $success to false
            $success = false;
            break;
        }
    }

    // Set message based on success or failure
    if ($success) {
        $message = "<p class='alert alert-success'>Notices successfully sent for all participants!</p>";
    } else {
        $message = "<p class='alert alert-danger'>Error sending notices. Please try again.</p>";
    }
}

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Approved Exam Participation List</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Approved Participation List</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>List of Approved Participation Requests</h5>
                </div>
                <div class="card-body">
                    <!-- Display success or failure message -->
                    <?php if ($message != ''): ?>
                        <div id="message"><?php echo $message; ?></div>
                    <?php endif; ?>
                    
                    <!-- Form for sending notices -->
                    <form method="POST" action="">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Student Name</th>
                                    <th>Student ID</th>
                                    <th>Session</th>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Course Credit</th>
                                    <th>Year</th>
                                    <th>Semester</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 0;
                                while ($row = mysqli_fetch_assoc($approved_list_result)): ?>
                                    <tr>
                                        <td><?php echo ++$counter; ?></td>
                                        <td><?php echo $row['student_name']; ?></td>
                                        <td><?php echo $row['student_id']; ?></td>
                                        <td><?php echo $row['session']; ?></td>
                                        <td><?php echo $row['course_code']; ?></td>
                                        <td><?php echo $row['course_title']; ?></td>
                                        <td><?php echo $row['course_credit']; ?></td>
                                        <td><?php echo $row['year']; ?></td>
                                        <td><?php echo $row['semester']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <div class="d-flex space-between">
                        <!-- Button to send notices -->
                        <button type="submit" name="send_notice" class="btn btn-primary me-2">
                            <i class="bi bi-send-fill"></i> Send All as Notice
                        </button>
                    </form>
                    
                    <!-- Button to download as PDF (for future implementation) -->
                    <a href="#" class="btn btn-success">
                        <i class="bi bi-file-earmark-pdf-fill"></i> Download All as PDF
                    </a>
                </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->

<?php include("footer.php"); ?>

<script>
    // JavaScript to hide the message after 5 seconds
    setTimeout(function() {
        var message = document.getElementById('message');
        if (message) {
            message.style.display = 'none';  // Hide the message
        }
    }, 5000);  // 5 seconds
</script>
