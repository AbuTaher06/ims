<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include("../include/connect.php");

$pageTitle = "Exam Controller | Pending Exam Lists";
include("header.php"); 
include("sidebar.php");

// Initialize filter variables with default values
$department = isset($_GET['department']) ? $_GET['department'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';
$session = isset($_GET['session']) ? $_GET['session'] : '';
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';

// Build the SQL query with optional filters
$pending_lists_query = "SELECT * FROM `exam_requests` WHERE sent_to_department = 'pending' AND reviewed_by_controller = 0";

// Apply filters
if (!empty($department)) {
    $pending_lists_query .= " AND department = '" . mysqli_real_escape_string($conn, $department) . "'";
}
if (!empty($year)) {
    $pending_lists_query .= " AND year = '" . mysqli_real_escape_string($conn, $year) . "'";
}
if (!empty($session)) {
    $pending_lists_query .= " AND session = '" . mysqli_real_escape_string($conn, $session) . "'";
}
if (!empty($semester)) {
    $pending_lists_query .= " AND semester = '" . mysqli_real_escape_string($conn, $semester) . "'";
}

$pending_lists_result = mysqli_query($conn, $pending_lists_query);

// Fetch all departments for the dropdown
$department_query = "SELECT username, dept_name FROM department";
$department_result = mysqli_query($conn, $department_query);

// Handle Approve All and Reject All actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['approve_all']) || isset($_POST['reject_all'])) {
        $selected_ids = $_POST['selected_ids'] ?? []; // Get selected IDs
        
        if (count($selected_ids) > 0) {
            $ids_list = implode(',', array_map('intval', $selected_ids)); // Convert IDs to a comma-separated list
            $sent_to_department = isset($_POST['approve_all']) ? 'Approved' : 'Rejected';
            
            // Prepare the update query
            $update_query = "UPDATE `exam_requests` SET reviewed_by_controller = 1, sent_to_department = '$sent_to_department' WHERE id IN ($ids_list)";
            mysqli_query($conn, $update_query);
            $_SESSION['success'] = count($selected_ids) . " requests $sent_to_department successfully.";
            header("Location: " . $_SERVER['PHP_SELF'] . '?' . http_build_query($_GET)); // Redirect to the same page
            exit();
        } else {
            $_SESSION['error'] = "No requests selected.";
        }
    }
}
?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Pending Exam Participation Lists</h1>
  </div><!-- End Page Title -->

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5>Pending Lists</h5>
        </div>
        <div class="card-body">

          <!-- Filter Form -->
          <form method="GET" action="" id="filterForm">
            <div class="row mb-50">
              <div class="col-md-3 bg-success">
                <label for="department">Department</label>
                <select name="department" id="department" class="form-control" onchange="submitForm()">
                  <option value="">Select Department</option>
                  <?php while($dept = mysqli_fetch_assoc($department_result)): ?>
                    <option value="<?php echo $dept['username']; ?>" <?php if($department == $dept['username']) echo 'selected'; ?>>
                      <?php echo $dept['dept_name']; ?>
                    </option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="col-md-3 bg-info pb-1">
                <label for="session">Current Session</label>
                <select name="session" id="session" class="form-control" onchange="submitForm()" required>
                  <option value="">Select Session</option>
                  <?php
                  for ($year = 2019; $year <= 2029; $year++) {
                      $next_year = $year + 1;
                      echo "<option value='{$year}-{$next_year}'" . (($session == "{$year}-{$next_year}") ? 'selected' : '') . ">{$year}-{$next_year}</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="col-md-3 bg-warning">
                <label for="year">Year</label>
                <select name="year" id="year" class="form-control" onchange="submitForm()">
                  <option value="">Select Years</option>
                  <option value="1" <?php if($year == '1') echo 'selected'; ?>>1st Year</option>
                  <option value="2" <?php if($year == '2') echo 'selected'; ?>>2nd Year</option>
                  <option value="3" <?php if($year == '3') echo 'selected'; ?>>3rd Year</option>
                  <option value="4" <?php if($year == '4') echo 'selected'; ?>>4th Year</option>
                </select>
              </div>

              <div class="col-md-3 bg-primary">
                <label for="semester">Semester</label>
                <select name="semester" id="semester" class="form-control" onchange="submitForm()">
                  <option value="">Select Semesters</option>
                  <option value="1" <?php if($semester == '1') echo 'selected'; ?>>1st Semester</option>
                  <option value="2" <?php if($semester == '2') echo 'selected'; ?>>2nd Semester</option>
                </select>
              </div>
            </div>
          </form>
          <!-- End Filter Form -->

          <form method="POST" id="approveRejectForm">
            <table class="table table-bordered mt-3">
              <thead>
                <tr>
                  <th><input type="checkbox" id="selectAll"><label for="selectAll">Select All</label></th>
                  <th>ID</th>
                  <th>Department</th>
                  <th>Student Name</th>
                  <th>Student ID</th>
                  <th>Session</th>
                  <th>Course Code</th>
                  <th>Course Title</th>
                  <th>Year</th>
                  <th>Semester</th>
                  <th>Request Date</th>
                  <th>Actions</th>
                  <th>View Transcript</th>
                </tr>
              </thead>
              <tbody>
                <?php if (mysqli_num_rows($pending_lists_result) > 0): ?>
                  <?php while ($row = mysqli_fetch_assoc($pending_lists_result)): ?>
                    <tr>
                      <td><input type="checkbox" name="selected_ids[]" value="<?php echo $row['id']; ?>"></td>
                      <td><?php echo $row['id']; ?></td>
                      <td><?php echo $row['department']; ?></td>
                      <td><?php echo $row['student_name']; ?></td>
                      <td><?php echo $row['student_id']; ?></td>
                      <td><?php echo $row['session']; ?></td>
                      <td><?php echo $row['course_code']; ?></td>
                      <td><?php echo $row['course_title']; ?></td>
                      <td><?php echo $row['year']; ?></td>
                      <td><?php echo $row['semester']; ?></td>
                      <td><?php echo $row['request_date']; ?></td>
                      <td><a href="review.php?id=<?php echo $row['id']; ?>" class="btn btn-warning"><i class="fas fa-eye"></i> Review</a></td>
                      <td><a href="transcript.php?id=<?php echo $row['student_id']; ?>" class="btn btn-info"><i class="fas fa-file-alt"></i> View Transcript</a></td>
                    </tr>
                  <?php endwhile; ?>
                <?php else: ?>
                  <tr><td colspan="13" class="text-center">No records found</td></tr>
                <?php endif; ?>
              </tbody>
            </table>

            <div class="row">
              <div class="col-md-6">
                <button type="submit" name="approve_all" class="btn btn-success"><i class="fas fa-check"></i> Approve All</button>
                <button type="submit" name="reject_all" class="btn btn-danger"><i class="fas fa-times"></i> Reject All</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success mt-3" id="flash-message">
      <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
  <?php endif; ?>

  <?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger mt-3" id="flash-message">
      <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
  <?php endif; ?>
</main>

<?php include("footer.php"); ?>

<script>
  function submitForm() {
    document.getElementById('filterForm').submit();
  }
  document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('input[name="selected_ids[]"]');
    checkboxes.forEach(checkbox => {
      checkbox.checked = this.checked;
    });
  });
  setTimeout(function() {
    $('#flash-message').fadeOut('slow');
  }, 5000);
</script>
