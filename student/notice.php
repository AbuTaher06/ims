<?php
session_start();
ob_start(); 

if (!isset($_SESSION['dept'])) {
    header("Location: ../deptlogin.php");
    ob_end_flush();
    exit();
}

$pageTitle = "View Notices";
include("header.php");
include("sidebar.php");
include("../include/connect.php");

// Get department from session
$dept = $_SESSION['dept'];

// Initialize search query variable
$search_query = "";

// Check if search has been performed
if (isset($_GET['search_student_id'])) {
    $search_student_id = mysqli_real_escape_string($conn, $_GET['search_student_id']); // Escape input
    $search_query = "AND ep.student_id LIKE '%$search_student_id%'"; // Add to query to search by student_id
}

// Fetch notices for the selected department and optionally filter by student_id
$notices_query = "SELECT n.id AS notice_id, n.notice_date, ep.student_name, ep.student_id, ep.course_code, ep.course_title
                  FROM notices n
                  INNER JOIN exam_participation_list ep ON n.participation_id = ep.id
                  WHERE ep.department = '$dept' $search_query
                  ORDER BY n.notice_date DESC";

// Execute query
$notices_result = mysqli_query($conn, $notices_query);

// Check if query is successful
if (!$notices_result) {
    die("Error fetching notices: " . mysqli_error($conn));
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Notices for Students in <?php echo $dept; ?> Department</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">View Notices</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5>Notices Sent to Students</h5>
                </div>
                <div class="card-body">
                    <!-- Search Form -->
                    <form method="GET" action="" class="form-inline mb-3">
                        <label for="search_student_id" class="mr-2">Search by Student ID:</label>
                        <input type="text" class="form-control mr-2" id="search_student_id" name="search_student_id" placeholder="Enter Student ID" value="<?php echo isset($_GET['search_student_id']) ? $_GET['search_student_id'] : ''; ?>">
                        <button type="submit" class="btn btn-info">Search</button>
                    </form>

                    <!-- Check if notices are available -->
                    <?php if (mysqli_num_rows($notices_result) > 0): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Notice ID</th>
                                    <th>Notice Date</th>
                                    <th>Student Name</th>
                                    <th>Student ID</th>
                                    <th>Course Code</th>
                                    <th>Course Title</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($row = mysqli_fetch_assoc($notices_result)): ?>
                                    <tr>
                                        <td><?php echo $row['notice_id']; ?></td>
                                        <td><?php echo date("d-m-Y", strtotime($row['notice_date'])); ?></td>
                                        <td><?php echo $row['student_name']; ?></td>
                                        <td><?php echo $row['student_id']; ?></td>
                                        <td><?php echo $row['course_code']; ?></td>
                                        <td><?php echo $row['course_title']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No notices found for the specified search criteria.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->

<?php include("footer.php"); ?>
