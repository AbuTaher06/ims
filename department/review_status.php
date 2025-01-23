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

$pageTitle = "Department | Dashboard";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");

$dept = $_SESSION['dept'];

// Initialize filter variables with default values
$year = isset($_GET['year']) ? $_GET['year'] : '';
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';

// Fetch exam participation requests for the logged department with optional filters
$exam_requests_query = "SELECT *
                        FROM `exam_requests`
                        WHERE department='$dept' AND reviewed_by_controller = 1 AND sent_to_department <> 'pending'";

// Apply filters
if (!empty($year)) {
    $exam_requests_query .= " AND year = '" . mysqli_real_escape_string($conn, $year) . "'";
}
if (!empty($semester)) {
    $exam_requests_query .= " AND semester = '" . mysqli_real_escape_string($conn, $semester) . "'";
}

$exam_requests_result = mysqli_query($conn, $exam_requests_query);

// Fetch distinct years and semesters for the filter dropdown
$years_query = "SELECT DISTINCT year FROM exam_requests WHERE department='$dept'";
$years_result = mysqli_query($conn, $years_query);

$semesters_query = "SELECT DISTINCT semester FROM exam_requests WHERE department='$dept'";
$semesters_result = mysqli_query($conn, $semesters_query);

// Handle sending to exam controller
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_to_controller'])) {
    $selected_ids = $_POST['selected_ids'] ?? []; // Get selected IDs

    if (count($selected_ids) > 0) {
        foreach ($selected_ids as $id) {
            // Fetch the row from exam_requests using the selected ID
            $request_query = "SELECT *
                              FROM `exam_requests` 
                              WHERE `id` = " . intval($id) . " AND department='$dept'";
            $request_result = mysqli_query($conn, $request_query);

            if ($request_result && mysqli_num_rows($request_result) > 0) {
                $row = mysqli_fetch_assoc($request_result);
                
                // Prepare the insert query for exam_participation_list
                $insert_query = "INSERT INTO `exam_participation_list` 
                                 (`department`, `student_name`, `student_id`, `session`, `phone`, `course_code`, 
                                  `course_title`, `course_credit`, `year`, `semester`, `status`, `request_date`) 
                                 VALUES 
                                 ('$dept', '" . mysqli_real_escape_string($conn, $row['student_name']) . "', 
                                  '" . mysqli_real_escape_string($conn, $row['student_id']) . "', 
                                  '" . mysqli_real_escape_string($conn, $row['session']) . "', 
                                  '" . mysqli_real_escape_string($conn, $row['phone']) . "', 
                                  '" . mysqli_real_escape_string($conn, $row['course_code']) . "', 
                                  '" . mysqli_real_escape_string($conn, $row['course_title']) . "', 
                                  '" . mysqli_real_escape_string($conn, $row['course_credit']) . "', 
                                  '" . mysqli_real_escape_string($conn, $row['year']) . "', 
                                  '" . mysqli_real_escape_string($conn, $row['semester']) . "', 
                                  'pending', 
                                  '" . mysqli_real_escape_string($conn, $row['request_date']) . "')";
                
                // Execute the insert query
                if (mysqli_query($conn, $insert_query)) {
                  // Update the status of the selected request
                  $update_status_query = "UPDATE `exam_requests` 
                                          SET `sent_to_controller` = 'sent' 
                                          WHERE `id` = " . intval($id);
                  
                  if (!mysqli_query($conn, $update_status_query)) {
                      $_SESSION['error'] = "Error updating status for " . $row['student_name'] . ": " . mysqli_error($conn);
                      break; // Exit the loop on error
                  }
              } else {
                  $_SESSION['error'] = "Error inserting request for " . $row['student_name'] . ": " . mysqli_error($conn);
                  break; // Exit the loop on error
              }
            }
             
        }

        // If the loop completes without breaking
        if (!isset($_SESSION['error'])) {
            $_SESSION['success'] = count($selected_ids) . " requests sent to the Exam Controller successfully.";
        }

        // Redirect to the same page with current filters
        header("Location: " . $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET));
        exit(); // Stop further execution
    } else {
        $_SESSION['error'] = "No requests selected to send.";
        // Redirect to the same page with current filters
        header("Location: " . $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET));
        exit(); // Stop further execution
    }
}
?>

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>Exam Participation List</h5>
                </div>
                <div class="card-body">

                    <!-- Filter Form -->
                    <form method="GET" action="">
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="year">Year</label>
                                <select name="year" id="year" class="form-control" onchange="submitForm()">
                                    <option value="">Select Year</option>
                                    <?php while($year_row = mysqli_fetch_assoc($years_result)): ?>
                                        <option value="<?php echo $year_row['year']; ?>" <?php if($year == $year_row['year']) echo 'selected'; ?>>
                                            <?php echo $year_row['year']; ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="semester">Semester</label>
                                <select name="semester" id="semester" class="form-control" onchange="submitForm()">
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
                        <table class="table table-striped table-bordered table-hover">
                            <thead style="background-color: #007bff; color: white;">
                                <tr>
                                    <th><input type="checkbox" id="selectAll"> Select All</th>
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
                                        <td class="<?php echo strtolower($row['sent_to_department']); ?>">
                                            <?php 
                                            // Display status with icon
                                            if ($row['sent_to_department'] === 'pending') {
                                                echo '<i class="fas fa-clock" style="color: orange;"></i> Pending';
                                            } elseif ($row['sent_to_department'] === 'sent') {
                                                echo '<i class="fas fa-check-circle" style="color: green;"></i> Approved';
                                            } elseif ($row['sent_to_department'] === 'rejected') {
                                                echo '<i class="fas fa-red-circle" style="color: red;"></i> Rejected';
                                            } else {
                                                echo $row['sent_to_department']; // Fallback for any other status
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $row['request_date']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                        <!-- Button to send list to Exam Controller -->
                        <!-- <button type="submit" class="btn btn-primary" name="send_to_controller">Send to Exam Controller</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success mt-3" id="flash-message">
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']); // Clear session success message
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger mt-3" id="flash-message">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']); // Clear session error message
            ?>
        </div>
    <?php endif; ?>
</main><!-- End #main -->


<script>
    // Automatically submit the form when any filter is changed
    function submitForm() {
        document.querySelector('form[action=""]').submit();
    }

    // Select or deselect all checkboxes
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });

    // Flash message timeout
    setTimeout(function() {
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.style.display = 'none'; // Hide flash message after timeout
        }
    }, 5000);
</script>



<style>
    /* Status color styles */
    .pending {
        color: orange; /* Color for pending status */
    }
    .sent {
        color: green; /* Color for sent status */
    }
    .error {
        color: red; /* Color for error status */
    }
</style>
