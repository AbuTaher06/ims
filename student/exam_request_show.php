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
$dept = $row['department'];
$student_id = $row['stud_id'];

// Fetch all pending requests
$query = "SELECT * 
          FROM `exam_requests` 
          WHERE `student_id` = '$student_id' 
          AND `department` = '$dept' 
          AND `status` = 'pending' 
          ORDER BY `request_date` DESC";


$result = mysqli_query($conn, $query);
?>

<main id="main" class="main">
    <div class="container mt-5">
        <h2 class="mb-4 text-center">Pending Course Retake Requests</h2>

        <?php if (mysqli_num_rows($result) > 0): ?>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Department</th>
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
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['student_name']; ?></td>
                            <td><?php echo $row['department']; ?></td>
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
        <?php else: ?>
            <p class="text-center">No pending requests found.</p>
        <?php endif; ?>
    </div>
</main>

<?php
include("footer.php");
?>
