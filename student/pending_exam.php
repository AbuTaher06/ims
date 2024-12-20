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
        --   AND `status` = 'pending' 
          ORDER BY `request_date` DESC";

$result = mysqli_query($conn, $query);
?>

<main id="main" class="main">
    <div class="container mt-5">
        <div class="card shadow-lg">
            <div class="card-header bg-primary text-white text-center">
                <h2 class="mb-0">Pending Requests for Course Retake </h2>
            </div>
            <div class="card-body">
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-dark text-center">
                                <tr>
                                    <th>#</th>
                                    <!-- <th>Name</th>
                                    <th>Department</th> -->
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                    <th>Course Credit</th>
                                    <th>Year</th>
                                    <th>Semester</th>
                                    <th>Transcript</th>
                                    <th>Status</th>
                                    <th>Request Date</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php 
                                $counter=0;
                                while ($row = mysqli_fetch_assoc($result)): ?>
                                    <tr>
                                        <td class="text-center"><?php echo ++$counter; ?></td>
                                        <!-- <td><?php echo $row['student_name']; ?></td>
                                        <td><?php echo $row['department']; ?></td> -->
                                        <td class="text-center"><?php echo $row['course_code']; ?></td>
                                        <td><?php echo $row['course_title']; ?></td>
                                        <td class="text-center"><?php echo $row['course_credit']; ?></td>
                                        <td class="text-center"><?php echo $row['year']; ?></td>
                                        <td class="text-center"><?php echo $row['semester']; ?></td>
                                        <td class="text-center">
                                            <?php if (!empty($row['transcript_path'])): ?>
                                                <a href="<?php echo $row['transcript_path']; ?>" target="_blank" class="btn btn-sm btn-success">
                                                    View Transcript
                                                </a>
                                            <?php else: ?>
                                                <span class="text-danger">Not Uploaded</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge bg-warning text-dark"><?php echo ucfirst($row['status']); ?></span>
                                        </td>
                                        <td class="text-center"><?php echo date('d M Y', strtotime($row['request_date'])); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-center text-muted">No pending requests found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</main>

<?php
include("footer.php");
?>
