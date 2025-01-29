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
$filter_semester = $_GET['semester'] ?? ''; // Assuming semester is also a filter

$filter_conditions = "WHERE `sent_from_department` = 'sent' AND `department` = '$dept' AND `reviewed_by_controller` = '1' and sent_to_department = 'approved'";
if ($filter_session) {
    $filter_conditions .= " AND `session` = '" . mysqli_real_escape_string($conn, $filter_session) . "'";
}
if ($filter_year) {
    $filter_conditions .= " AND `year` = '" . mysqli_real_escape_string($conn, $filter_year) . "'";
}
if ($filter_semester) {
    $filter_conditions .= " AND `semester` = '" . mysqli_real_escape_string($conn, $filter_semester) . "'";
}

$query = "SELECT * FROM `exam_requests` $filter_conditions";
$result = mysqli_query($conn, $query);
$approved_list_data = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch distinct session, year, and semester
$sessions_query = "SELECT DISTINCT `session` FROM `exam_requests` WHERE `department` = '$dept' ORDER BY `session` ASC";
$sessions_result = mysqli_query($conn, $sessions_query);
$sessions_list = mysqli_fetch_all($sessions_result, MYSQLI_ASSOC);

$years_query = "SELECT DISTINCT `year` FROM `exam_requests` WHERE `department` = '$dept' ORDER BY `year` ASC";
$years_result = mysqli_query($conn, $years_query);
$years_list = mysqli_fetch_all($years_result, MYSQLI_ASSOC);

$semesters_query = "SELECT DISTINCT `semester` FROM `exam_requests` WHERE `department` = '$dept' ORDER BY `semester` ASC";
$semesters_result = mysqli_query($conn, $semesters_query);
$semesters_list = mysqli_fetch_all($semesters_result, MYSQLI_ASSOC);

// Handle PDF download
if (isset($_GET['download_pdf'])) {
    $dompdf = new Dompdf();
    ob_start();
    // Building the header with logo
    if (isset($_GET['download_pdf'])) {
        ob_start(); // Start output buffering
        $dompdf = new Dompdf();
    
        // Building the HTML content
        $html = '
        <div style="text-align: center; margin-bottom: 20px; position: relative;">
            <div style="display: flex; align-items: center; justify-content: center; margin-bottom: 10px;">
                <div style="text-align: right; flex: 1;">
                    <h2 style="margin: 0;">Dept. of ' . htmlspecialchars($dept_name) . '</h2>
                    <p style="margin: 0; font-size: 14px;">Jatiya Kabi Kazi Nazrul Islam University</p>
                    <p style="margin: 0; font-size: 12px;">Trishal, Mymensingh - 2224, Bangladesh</p>
                </div>
                // <div style="flex-shrink: 0; margin: 0 15px;">
                //     <img src="/absolute/path/to/asset/images/jkkniu.png" alt="Logo" style="width: 80px; height: 80px; display: block; margin: auto;">
                // </div>
                <div style="text-align: left; flex: 1;">
                    <h2 style="margin: 0;">কম্পিউটার বিজ্ঞান ও প্রকৌশল বিভাগ</h2>
                    <p style="margin: 0; font-size: 14px;">জাতীয় কবি কাজী নজরুল ইসলাম বিশ্ববিদ্যালয়</p>
                    <p style="margin: 0; font-size: 12px;">ত্রিশাল, ময়মনসিংহ - ২২২৪, বাংলাদেশ</p>
                </div>
            </div>
            <hr style="border: 1px solid black; margin: 10px 0;">
        </div>';
        ob_end_clean(); // Clean the output buffer and stop output buffering
    
        $html .= '<h1 style="text-align:center;">Approved Exam Participation List</h1>';
        $html .= '<table border="1" cellspacing="0" cellpadding="5" style="width:100%;">';
        $html .= '<thead><tr><th>#</th><th>Student Name</th><th>Student ID</th><th>Session</th><th>Course Code</th><th>Course Title</th><th>Course Credit</th><th>Year</th><th>Semester</th></tr></thead><tbody>';
    
        $counter = 0;
        foreach ($approved_list_data as $row) {
            $html .= '<tr><td>' . ++$counter . '</td><td>' . htmlspecialchars($row['student_name']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['student_id']) . '</td><td>' . htmlspecialchars($row['session']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['course_code']) . '</td><td>' . htmlspecialchars($row['course_title']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['course_credit']) . '</td><td>' . htmlspecialchars($row['year']) . '</td>';
            $html .= '<td>' . htmlspecialchars($row['semester']) . '</td></tr>';
        }
        $html .= '</tbody></table>';
    
        // Load HTML and render
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
    
        // Stream the PDF
        $filename = 'approved_participation_list.pdf';
        $dompdf->stream($filename, ['Attachment' => true]);
        exit();
    }
    


    $html = '<h1 style="text-align:center;">Approved Exam Participation List</h1>';
    $html .= '<table border="1" cellspacing="0" cellpadding="5" style="width:100%;">';
    $html .= '<thead><tr><th>#</th><th>Student Name</th><th>Student ID</th><th>Session</th><th>Course Code</th><th>Course Title</th><th>Course Credit</th><th>Year</th><th>Semester</th></tr></thead><tbody>';
    $counter = 0;
    foreach ($approved_list_data as $row) {
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

    // Set the filename with year, session, semester, and handle empty selections
    $filename = 'all_approved_participation_list.pdf'; // Default filename
    if ($filter_year || $filter_session || $filter_semester) {
        $filename = ($filter_year ?: 'all_year') . '_' . ($filter_session ?: 'all') . '_' . ($filter_semester ?: 'all_semester') . '_approved_participation_list.pdf';
    }
    
    $dompdf->stream($filename, ['Attachment' => true]);
    exit();
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Approved Exam Participation List</h1>
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
            <div class="col-md-3">
                <label for="semester" class="form-label">Semester</label>
                <select id="semester" class="form-control">
                    <option value="">All</option>
                    <?php foreach ($semesters_list as $semester): ?>
                        <option value="<?php echo htmlspecialchars($semester['semester']); ?>"
                            <?php echo $filter_semester === $semester['semester'] ? 'selected' : ''; ?>>
                            <?php echo htmlspecialchars($semester['semester']); ?>
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
                    <?php if (count($approved_list_data) > 0): ?>
                        <?php foreach ($approved_list_data as $index => $row): ?>
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
            <a href="?download_pdf=true&session=<?php echo urlencode($filter_session); ?>&year=<?php echo urlencode($filter_year); ?>&semester=<?php echo urlencode($filter_semester); ?>" class="btn btn-success">
                <i class="bi bi-file-earmark-pdf-fill"></i> Download PDF
            </a>
        </div>
    </div>
</main>

<?php include("footer.php"); ?>

<script>
document.getElementById('session').addEventListener('change', function () {
    const year = document.getElementById('year').value;
    const semester = document.getElementById('semester').value;
    const session = this.value;
    window.location.href = `?session=${encodeURIComponent(session)}&year=${encodeURIComponent(year)}&semester=${encodeURIComponent(semester)}`;
});

document.getElementById('year').addEventListener('change', function () {
    const session = document.getElementById('session').value;
    const semester = document.getElementById('semester').value;
    const year = this.value;
    window.location.href = `?session=${encodeURIComponent(session)}&year=${encodeURIComponent(year)}&semester=${encodeURIComponent(semester)}`;
});

document.getElementById('semester').addEventListener('change', function () {
    const session = document.getElementById('session').value;
    const year = document.getElementById('year').value;
    const semester = this.value;
    window.location.href = `?session=${encodeURIComponent(session)}&year=${encodeURIComponent(year)}&semester=${encodeURIComponent(semester)}`;
});
</script>
