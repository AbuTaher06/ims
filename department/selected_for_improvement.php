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

$pageTitle = "Approved Participation List";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");

// Get department from session
$dept = $_SESSION['dept'];

// Fetch participation list with status 'Approved' for the current department and session
$approved_list_query = "SELECT `id`, `student_name`, `student_id`, `session`, `phone`, `course_code`, `course_title`, 
                        `course_credit`, `year`, `semester`, `status`, `request_date`
                        FROM `exam_participation_list`
                        WHERE `department` = '$dept' AND `status` = 'Approved'";

// Execute query
$approved_list_result = mysqli_query($conn, $approved_list_query);

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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Student Name</th>
                                <th>Student ID</th>
                                <th>Session</th>
                                <th>Phone</th>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Course Credit</th>
                                <th>Year</th>
                                <th>Semester</th>
                                <th>Status</th>
                                <th>Request Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($approved_list_result)): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['student_name']; ?></td>
                                    <td><?php echo $row['student_id']; ?></td>
                                    <td><?php echo $row['session']; ?></td>
                                    <td><?php echo $row['phone']; ?></td>
                                    <td><?php echo $row['course_code']; ?></td>
                                    <td><?php echo $row['course_title']; ?></td>
                                    <td><?php echo $row['course_credit']; ?></td>
                                    <td><?php echo $row['year']; ?></td>
                                    <td><?php echo $row['semester']; ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td><?php echo $row['request_date']; ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->

<?php include("footer.php"); ?>
