<?php
session_start();
require_once '../vendor/autoload.php'; // Dompdf inclusion
use Dompdf\Dompdf;

if (!isset($_SESSION['dept'])) {
    header("Location: ../deptlogin.php");
    exit();
}

include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");

// Set department from session
$dept = $_SESSION['dept'];

// Handle dynamic filtering
$filter_session = $_GET['session'] ?? '';
$filter_year = $_GET['year'] ?? '';

$filter_conditions = "WHERE `sent_to_department` = 'rejected' AND `department` = '$dept' AND `reviewed_by_controller` = '1'";
if ($filter_session) {
    $filter_conditions .= " AND `session` = '" . mysqli_real_escape_string($conn, $filter_session) . "'";
}
if ($filter_year) {
    $filter_conditions .= " AND `year` = '" . mysqli_real_escape_string($conn, $filter_year) . "'";
}

$query = "SELECT * FROM `exam_requests` $filter_conditions";
$result = mysqli_query($conn, $query);
$rejected_list_data = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch distinct session and year
$sessions_query = "SELECT DISTINCT `session` FROM `exam_requests` WHERE `department` = '$dept' ORDER BY `session` ASC";
$sessions_result = mysqli_query($conn, $sessions_query);
$sessions_list = mysqli_fetch_all($sessions_result, MYSQLI_ASSOC);

$years_query = "SELECT DISTINCT `year` FROM `exam_requests` WHERE `department` = '$dept' ORDER BY `year` ASC";
$years_result = mysqli_query($conn, $years_query);
$years_list = mysqli_fetch_all($years_result, MYSQLI_ASSOC);

// Handle PDF download
if (isset($_GET['download_pdf'])) {
    $dompdf = new Dompdf();
    ob_end_clean();
    $html = '<h1 style="text-align:center;">rejected Exam Participation List</h1>';
    $html .= '<table border="1" cellspacing="0" cellpadding="5" style="width:100%;">';
    $html .= '<thead><tr><th>#</th><th>Student Name</th><th>Student ID</th><th>Session</th><th>Course Code</th><th>Course Title</th><th>Course Credit</th><th>Year</th><th>Semester</th></tr></thead><tbody>';
    $counter = 0;
    foreach ($rejected_list_data as $row) {
        $html .= '<tr><td>' . ++$counter . '</td><td>' . htmlspecialchars($row['student_name']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['student_id']) . '</td><td>' . htmlspecialchars($row['session']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['course_code']) . '</td><td>' . htmlspecialchars($row['course_title']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['course_credit']) . '</td><td>' . htmlspecialchars($row['year']) . '</td>';
        $html .= '<td>' . htmlspecialchars($row['semester']) . '</td></tr>';
    }
    $html .= '</tbody></table>';
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('rejected_participation_list.pdf', ['Attachment' => true]);
    exit();
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Rejected Exam Participation List</h1>
        <div class="row g-2">
            <div class="col-md-3">
                <label for="session" class="form-label">Session</label>
                <select id="session" class="form-control">
                    <option value="">All</option>
                    <?php foreach ($sessions_list as $session): ?>
                        <option value="<?php echo htmlspecialchars($session['session']); ?>"
                            <?php echo $filter_session === $session['session'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($session['session']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label for="year" class="form-label">Year</label>
                <select id="year" class="form-control">
                    <option value="">All</option>
                    <?php foreach ($years_list as $year): ?>
                        <option value="<?php echo htmlspecialchars($year['year']); ?>"
                            <?php echo $filter_year === $year['year'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($year['year']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Filtered Participation Requests</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Student Name</th>
                        <th>Student ID</th>
                        <th>Session</th>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Course Credit</th>
                        <th>Year</th>
                        <th>Semester</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($rejected_list_data) > 0): ?>
                        <?php foreach ($rejected_list_data as $index => $row): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($row['student_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['student_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['session']); ?></td>
                            <td><?php echo htmlspecialchars($row['course_code']); ?></td>
                            <td><?php echo htmlspecialchars($row['course_title']); ?></td>
                            <td><?php echo htmlspecialchars($row['course_credit']); ?></td>
                            <td><?php echo htmlspecialchars($row['year']); ?></td>
                            <td><?php echo htmlspecialchars($row['semester']); ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9" class="text-center">No records found for the selected filters.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <a href="?download_pdf=true&session=<?php echo urlencode($filter_session); ?>&year=<?php echo urlencode($filter_year); ?>" class="btn btn-success">
                <i class="bi bi-file-earmark-pdf-fill"></i> Download PDF
            </a>
        </div>
    </div>
</main>

<?php include("footer.php"); ?>

<script>
document.getElementById('session').addEventListener('change', function () {
    const year = document.getElementById('year').value;
    const session = this.value;
    window.location.href = `?session=${encodeURIComponent(session)}&year=${encodeURIComponent(year)}`;
});

document.getElementById('year').addEventListener('change', function () {
    const session = document.getElementById('session').value;
    const year = this.value;
    window.location.href = `?session=${encodeURIComponent(session)}&year=${encodeURIComponent(year)}`;
});
</script>
