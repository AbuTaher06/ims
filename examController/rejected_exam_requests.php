<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../include/connect.php");

$pageTitle = "Rejected Exam Requests";
include("header.php"); 
include("sidebar.php"); 

// Fetch rejected exam requests
$rejected_requests_query = "SELECT * FROM `exam_participation_list` WHERE reviewed_by_controller = 1 AND status = 'Rejected'";
$rejected_requests_result = mysqli_query($conn, $rejected_requests_query);

?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Rejected Exam Requests</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Rejected Exam Requests</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>Rejected Exam Requests</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Department</th>
                                <th>Student Name</th>
                                <th>Student ID</th>
                                <th>Session</th>
                                <th>Course Code</th>
                                <th>Course Title</th>
                                <th>Year</th>
                                <th>Semester</th>
                                <th>Status</th>
                                <th>Request Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($rejected_requests_result)): ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php echo $row['department']; ?></td>
                                    <td><?php echo $row['student_name']; ?></td>
                                    <td><?php echo $row['student_id']; ?></td>
                                    <td><?php echo $row['session']; ?></td>
                                    <td><?php echo $row['course_code']; ?></td>
                                    <td><?php echo $row['course_title']; ?></td>
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
