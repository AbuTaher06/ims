<?php
session_start();

require_once '../vendor/autoload.php'; // Dompdf inclusion
use Dompdf\Dompdf;
use Dompdf\Options;

if (!isset($_SESSION['controller'])) {
    header("Location: examcontroller_login.php");
    exit();
}
include("../include/connect.php");

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

$pageTitle = "Exam Controller | Pending Exam Lists";
include("header.php"); 
include("sidebar.php");

// Initialize filter variables with default values
$department = isset($_GET['department']) ? $_GET['department'] : '';
$year = isset($_GET['year']) ? $_GET['year'] : '';
$session = isset($_GET['session']) ? $_GET['session'] : '';
$semester = isset($_GET['semester']) ? $_GET['semester'] : '';

// Build the SQL query with optional filters
$pending_lists_query = "SELECT * FROM `exam_requests` WHERE sent_to_department = 'pending' AND sent_from_department='sent' AND reviewed_by_controller = 0";

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

// Handle PDF download request
// Handle PDF download request
if (isset($_GET['download_pdf'])) {
  // Create a new Dompdf instance
  $options = new Options();
  $options->set('defaultFont', 'Courier');
  $dompdf = new Dompdf($options);

  // Fetch filtered results again for PDF generation
  $pending_lists_result = mysqli_query($conn, $pending_lists_query);
  
  // Create HTML content for PDF
  $html = '<h2>Pending Exam Requests</h2>';
  $html .= '<table border="1" cellpadding="4" style="width: 100%; border-collapse: collapse;">
              <tr>
                  <th>#</th>
                  <th>Department</th>
                  <th>Student Name</th>
                  <th>Student ID</th>
                  <th>Session</th>
                  <th>Course Code</th>
                  <th>Course Title</th>
                  <th>Year</th>
                  <th>Semester</th>
                  <th>Request Date</th>
                  <th>View Transcript</th>
              </tr>';
     
  // Add data to the table
  while ($row = mysqli_fetch_assoc($pending_lists_result)) {
      $html .= '<tr>
                  <td>' . htmlspecialchars($row['id']) . '</td>
                  <td>' . htmlspecialchars($row['department']) . '</td>
                  <td>' . htmlspecialchars($row['student_name']) . '</td>
                  <td>' . htmlspecialchars($row['student_id']) . '</td>
                  <td>' . htmlspecialchars($row['session']) . '</td>
                  <td>' . htmlspecialchars($row['course_code']) . '</td>
                  <td>' . htmlspecialchars($row['course_title']) . '</td>
                  <td>' . htmlspecialchars($row['year']) . '</td>
                  <td>' . htmlspecialchars($row['semester']) . '</td>
                  <td>' . htmlspecialchars($row['request_date']) . '</td>
                  <td><a href="../student/transcripts/' . basename($row['transcript_path']) . '" target="_blank">View Transcript</a></td>
                </tr>';
  }
  $html .= '</table>';

  // Load HTML content to Dompdf
  $dompdf->loadHtml($html);
  // Set paper size and orientation
  $dompdf->setPaper('A4', 'landscape');
  // Render the HTML as PDF
  $dompdf->render();
  
  // Output the generated PDF to browser
  $dompdf->stream('pending_exam_requests.pdf', ['Attachment' => true]);
  exit();
}

?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Pending Improvement Application</h1>
  </div><!-- End Page Title -->

  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-header">
          <h5>Pending Lists</h5>
          <!-- Download PDF Button -->
          <a href="?download_pdf=1&department=<?php echo urlencode($department); ?>&year=<?php echo urlencode($year); ?>&session=<?php echo urlencode($session); ?>&semester=<?php echo urlencode($semester); ?>" class="btn btn-primary float-right">Download PDF</a>
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
                    <option value="<?php echo htmlspecialchars($dept['username']); ?>" <?php if($department == $dept['username']) echo 'selected'; ?>>
                      <?php echo htmlspecialchars($dept['dept_name']); ?>
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
                  <th>#</th>
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
                <?php if (mysqli_num_rows($pending_lists_result) > 0): 
                  $counter = 1;
                  ?>
                  <?php while ($row = mysqli_fetch_assoc($pending_lists_result)): ?>
                    <tr>
                      <td><input type="checkbox" name="selected_ids[]" value="<?php echo htmlspecialchars($row['id']); ?>"></td>
                      <td><?php echo $counter++; ?></td>
                      <td><?php echo htmlspecialchars($row['department']); ?></td>
                      <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                      <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                      <td><?php echo htmlspecialchars($row['session']); ?></td>
                      <td><?php echo htmlspecialchars($row['course_code']); ?></td>
                      <td><?php echo htmlspecialchars($row['course_title']); ?></td>
                      <td><?php echo htmlspecialchars($row['year']); ?></td>
                      <td><?php echo htmlspecialchars($row['semester']); ?></td>
                      <td><?php echo htmlspecialchars($row['request_date']); ?></td>
                      <td><a href="review.php?id=<?php echo htmlspecialchars($row['id']); ?>" class="btn btn-warning"><i class="fas fa-eye"></i> Review</a></td>
                      <td>
                        <a href="../student/transcripts/<?php echo basename($row['transcript_path']); ?>" target="_blank">
                          <i class="fas fa-file-alt"></i> View Transcript
                        </a>
                      </td>
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
    const flashMessages = document.querySelectorAll('#flash-message');
    flashMessages.forEach(msg => {
      msg.style.display = 'none';
    });
  }, 5000);
</script>

<?php include("footer.php"); ?>
