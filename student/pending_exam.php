<?php
session_start();
$pageTitle = "Pending Requests";
include("header.php");
include("sidebar.php");
include("../include/connect.php");

$uname = $_SESSION['student'];
$sql = "SELECT * FROM students WHERE email='$uname'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$dept_name = $row['department'];
$student_id = $row['stud_id'];

$dept_sql = "SELECT * FROM department WHERE dept_name='$dept_name'";
$dept_res = mysqli_query($conn, $dept_sql);
$dept_row = mysqli_fetch_assoc($dept_res);
$dept = $dept_row['username'];

// Handle edit request (POST method)
// Handle edit request (POST method)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit_request'])) {
    $course_code = $_POST['course_code'];
    $course_title = $_POST['course_title'];
    $course_credit = $_POST['course_credit'];
    $semester = $_POST['semester'];
    $year = $_POST['year']; // Get the year from the form
    $id = $_POST['request_id'];

    // Update query
    $update_query = "UPDATE `exam_requests` SET 
                     `course_code` = '$course_code',
                     `course_title` = '$course_title',
                     `course_credit` = '$course_credit',
                     `semester` = '$semester',
                     `year` = '$year' 
                     WHERE `id` = '$id'";

    // Debugging line: Output the query to check it
    echo $update_query; // Remove this line after debugging

    // Execute the query with error handling
    if (!mysqli_query($conn, $update_query)) {
        echo "Error updating request: " . mysqli_error($conn);
    } else {
        $_SESSION['flash_message'] = "Request updated successfully!";
        header("Location: " . $_SERVER['PHP_SELF']); // Refresh the page after updating
        exit;
    }
}


// Handle delete request
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Delete query
    $delete_query = "DELETE FROM `exam_requests` WHERE `id` = '$delete_id'";

    if (mysqli_query($conn, $delete_query)) {
        $_SESSION['flash_message'] = "Request deleted successfully!";
        header("Location: " . $_SERVER['PHP_SELF']); // Refresh the page after deleting
        exit;
    } else {
        $_SESSION['flash_message'] = "Error deleting request: " . mysqli_error($conn);
    }
}

// Fetch all pending requests
$query = "SELECT * 
          FROM `exam_requests` 
          WHERE `student_id` = '$student_id' 
          AND `department` = '$dept' 
          AND `sent_from_department` = 'pending' 
          ORDER BY `request_date` DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<main id="main" class="main">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h2 class="mb-0">Pending Course Improvement Application</h2>
            </div>
            <div class="card-body">
                <?php if (isset($_SESSION['flash_message'])): ?>
                    <div class="alert alert-info text-center">
                        <?php echo $_SESSION['flash_message']; unset($_SESSION['flash_message']); ?>
                    </div>
                <?php endif; ?>

                <?php if (mysqli_num_rows($result) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>#</th>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Course Credit</th>
                                    <th>Year</th>
                                    <th>Semester</th>
                                    <th>Transcript</th>
                                    <th>Status</th>
                                    <th>Request Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $counter = 0;
                                while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="text-center"><?php echo ++$counter; ?></td>
                                        <td class="text-center"><?php echo $row['course_code']; ?></td>
                                        <td><?php echo $row['course_title']; ?></td>
                                        <td class="text-center"><?php echo $row['course_credit']; ?></td>
                                        <td class="text-center"><?php echo $row['year']; ?></td>
                                        <td class="text-center"><?php echo $row['semester']; ?></td>
                                        <td class="text-center">
                                            <?php if (!empty($row['transcript_path'])): ?>
                                                <a href="<?php echo $row['transcript_path']; ?>" target="_blank" class="btn btn-sm btn-success">
                                                  <i class="fas fa-eye"></i> View Transcript
                                                </a>
                                            <?php else: ?>
                                                <span class="text-danger">Not Uploaded</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-warning text-dark"><?php echo ucfirst($row['sent_from_department']); ?></span>
                                        </td>
                                        <td class="text-center"><?php echo date('d M Y', strtotime($row['request_date'])); ?></td>
                                        <td class="text-center">
                                            <!-- Edit Icon -->
                                            <a href="#editModal<?php echo $row['id']; ?>" data-bs-toggle="modal" class="btn btn-sm btn-info">
                                                <i class="fas fa-edit"></i> 
                                            </a>
                                            <!-- Delete Icon -->
                                            <a href="?delete_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this request?');">
                                                <i class="fas fa-trash-alt"></i> 
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Modal for Edit -->
                                    <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel">Edit Request</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="">
                                                        <input type="hidden" name="request_id" value="<?php echo $row['id']; ?>">
                                                        <div class="mb-3">
                                                            <label for="course_code" class="form-label">Course Code</label>
                                                            <input type="text" class="form-control" id="course_code" name="course_code" value="<?php echo $row['course_code']; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="course_title" class="form-label">Course Title</label>
                                                            <input type="text" class="form-control" id="course_title" name="course_title" value="<?php echo $row['course_title']; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="course_credit" class="form-label">Course Credit</label>
                                                            <input type="number" class="form-control" id="course_credit" name="course_credit" value="<?php echo $row['course_credit']; ?>" required>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="year" class="form-label">Year</label>
                                                            <select class="form-control" id="year" name="year" required>
                                                                <option value="1st Year" <?php echo ($row['year'] == '1st Year') ? 'selected' : ''; ?>>1st Year</option>
                                                                <option value="2nd Year" <?php echo ($row['year'] == '2nd Year') ? 'selected' : ''; ?>>2nd Year</option>
                                                                <option value="3rd Year" <?php echo ($row['year'] == '3rd Year') ? 'selected' : ''; ?>>3rd Year</option>
                                                                <option value="4th Year" <?php echo ($row['year'] == '4th Year') ? 'selected' : ''; ?>>4th Year</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="semester" class="form-label">Semester</label>
                                                            <select class="form-control" id="semester" name="semester" required>
                                                                <option value="1st" <?php echo ($row['semester'] == '1st') ? 'selected' : ''; ?>>1st</option>
                                                                <option value="2nd" <?php echo ($row['semester'] == '2nd') ? 'selected' : ''; ?>>2nd</option>
                                                            </select>
                                                        </div>
                                                        <button type="submit" name="edit_request" class="btn btn-primary">Save Changes</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning text-center">No pending requests found.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
