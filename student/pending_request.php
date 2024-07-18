<?php
session_start();
include("header.php");
include("../include/connect.php");

// Fetch data from the 'imp_form' table where status is 'Pending'
$student = isset($_SESSION['students']) ? $_SESSION['students'] : '';
if (empty($student)) {
    die("No student session data found.");
}

$sql = "SELECT course_details FROM imp_form WHERE student_name_english='$student' AND course_details <> '' AND status='Pending'";
$res = mysqli_query($conn, $sql);

// Check for SQL errors
if (!$res) {
    die("Error executing query: " . mysqli_error($conn));
}

?>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <h4 class="text-danger text-center my-2">
                    Your Pending Request
                    <i class="fas fa-exclamation-circle"></i> <!-- Pending icon -->
                </h4>

                <div class="card">
                    <div class="card-body">
                        <?php
                        if (mysqli_num_rows($res) == 0) {
                            echo "<p>No data available</p>";
                        } else {
                            echo "
                            <table class='table table-bordered table-striped'>
                                <thead class='awesome-header bg-secondary'>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Year</th>
                                        <th>Semester</th>
                                        <th>Course Code</th>
                                        <th>Credit</th>
                                        <th>Course Title</th>
                                        <th>GPA Obtained</th>
                                        <th>Exam Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                            ";

                            while ($row = mysqli_fetch_assoc($res)) {
                                // Decode JSON data
                                $course_details = json_decode($row['course_details'], true);

                                if (json_last_error() !== JSON_ERROR_NONE) {
                                    echo "<p>Error decoding JSON: " . json_last_error_msg() . "</p>";
                                    continue;
                                }

                                foreach ($course_details as $course) {
                                    // Check if all fields are present and serial number is not empty
                                    if (!empty($course['serialNo']) && !empty($course['year']) && !empty($course['semester']) && !empty($course['courseCode']) && !empty($course['courseCredit']) && !empty($course['courseTitle']) && !empty($course['gpaObtained']) && !empty($course['examType'])) {
                                        $serial_no = htmlspecialchars($course['serialNo']);
                                        $year = htmlspecialchars($course['year']);
                                        $semester = htmlspecialchars($course['semester']);
                                        $course_code = htmlspecialchars($course['courseCode']);
                                        $credit = htmlspecialchars($course['courseCredit']);
                                        $course_title = htmlspecialchars($course['courseTitle']);
                                        $gpa = htmlspecialchars($course['gpaObtained']);
                                        $exam_type = htmlspecialchars($course['examType']);
                                        // Output table row
                                        echo "
                                        <tr>
                                            <td>$serial_no</td>
                                            <td>$year</td>
                                            <td>$semester</td>
                                            <td>$course_code</td>
                                            <td>$credit</td>
                                            <td>$course_title</td>
                                            <td>$gpa</td>
                                            <td>$exam_type</td>
                                        </tr>
                                        ";
                                    }
                                }
                            }

                            echo "</tbody></table>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("../footer.php"); ?>
