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

$pageTitle = "Pending Requests";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");

$dept_name = $_SESSION['dept'];
$dept_sql = "select * from department where username='$dept_name'";
$dept_result = mysqli_query($conn, $dept_sql);
$dept_row = mysqli_fetch_assoc($dept_result);
$dept = $dept_row['username'];



// Initialize filter variables with default values
$year = isset($_GET['year']) ? $_GET['year'] : '';
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';

// Fetch exam participation requests for the logged department with optional filters
$exam_requests_query = "SELECT `id`, `student_name`, `student_id`, `session`, `phone`, `course_code`, 
                               `course_title`, `course_credit`, `year`, `semester`, `transcript_path`, 
                               `request_date` 
                        FROM `exam_requests`
                        WHERE department = '" . mysqli_real_escape_string($conn, $dept) . "' 
                        AND sent_from_department = 'pending'"; // Adjusted to include all records

// Apply filters
if (!empty($year)) {
    $exam_requests_query .= " AND year = '" . mysqli_real_escape_string($conn, $year) . "'";
}
if (!empty($semester)) {
    $exam_requests_query .= " AND semester = '" . mysqli_real_escape_string($conn, $semester) . "'";
}

$exam_requests_result = mysqli_query($conn, $exam_requests_query);

// Fetch distinct years and semesters for the filter dropdown
$years_query = "SELECT DISTINCT year FROM exam_requests WHERE department = '" . mysqli_real_escape_string($conn, $dept) . "'";
$years_result = mysqli_query($conn, $years_query);

$semesters_query = "SELECT DISTINCT semester FROM exam_requests WHERE department = '" . mysqli_real_escape_string($conn, $dept) . "'";
$semesters_result = mysqli_query($conn, $semesters_query);

// Handle sending to exam controller
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_to_controller'])) {
    $selected_ids = $_POST['selected_ids'] ?? [];

    if (count($selected_ids) > 0) {
        foreach ($selected_ids as $id) {
            $update_status_query = "UPDATE `exam_requests` 
                                    SET `sent_from_department` = 'sent' 
                                    WHERE `id` = " . intval($id) . " 
                                    AND `department` = '" . mysqli_real_escape_string($conn, $dept) . "' 
                                    AND `sent_from_department` = 'pending'";
            if (!mysqli_query($conn, $update_status_query)) {
                $_SESSION['error'] = "Error updating status for request ID " . intval($id) . ": " . mysqli_error($conn);
                break; // Stop on the first error
            }
        }

        if (!isset($_SESSION['error'])) {
            $_SESSION['success'] = count($selected_ids) . " requests updated successfully.";
        }
        header("Location: " . $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET));
        exit();
    } else {
        $_SESSION['error'] = "No requests selected to update.";
        header("Location: " . $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET));
        exit();
    }
}

?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Pending Requests</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Pending Requests</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>Pending Exam Participation Requests</h5>
                </div>
                <div class="card-body">

                    <!-- Filter Form -->
                    <form method="GET" action="">
                        <div class="row mb-3">
                        <div class="col-md-3 bg-info mb-3 pb-1">
                                <label for="year">Year</label>
                                <select name="year" id="year" class="form-control" onchange="this.form.submit()">
                                    <option value="">Select Year</option>
                                    <?php while($year_row = mysqli_fetch_assoc($years_result)): ?>
                                        <option value="<?php echo $year_row['year']; ?>" <?php if($year == $year_row['year']) echo 'selected'; ?>>
                                            <?php echo $year_row['year']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md-3 bg-warning mb-3">
                                <label for="semester">Semester</label>
                                <select name="semester" id="semester" class="form-control" onchange="this.form.submit()">
                                    <option value="">Select Semester</option>
                                    <?php while($semester_row = mysqli_fetch_assoc($semesters_result)): ?>
                                        <option value="<?php echo $semester_row['semester']; ?>" <?php if($semester == $semester_row['semester']) echo 'selected'; ?>>
                                            <?php echo $semester_row['semester']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                    </form>
                    <!-- End Filter Form -->

                    <form method="POST" action="">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" id="selectAll"> <label for="selectAll">Select All</label></th>
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
                                    <th>Transcript</th>
                                    <th>Request Date</th>
                                    <th>Review Documents</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($exam_requests_result)): ?>
                                    <tr>
                                        <td><input type="checkbox" name="selected_ids[]" value="<?php echo $row['id']; ?>"></td>
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
                                        <td>
                                            <?php if (!empty($row['transcript_path'])): ?>
                                                <a href="../student/transcripts/<?php echo basename($row['transcript_path']); ?>" target="_blank">
                                                    <i class="fas fa-file-alt"></i> View Transcript
                                                </a>
                                            <?php else: ?>
                                                No Transcript
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $row['request_date']; ?></td>
                                        <td>
                                            <a href="review.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">
                                                <i class="fas fa-eye"></i> Review
                                            </a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <!-- Button to send list to Exam Controller -->
                        <button type="submit" class="btn btn-primary" name="send_to_controller">
                            <i class="fas fa-paper-plane"></i> Send to Exam Controller
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success mt-3" id="flash-message">
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']); // Clear the success message after displaying
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger mt-3" id="flash-message">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']); // Clear the error message after displaying
            ?>
        </div>
    <?php endif; ?>
</main><!-- End #main -->

<script>
// JavaScript to handle "Select All" checkbox functionality
document.getElementById('selectAll').onclick = function() {
    const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
    for (let checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
};
</script>
