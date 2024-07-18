<?php
// Include mPDF library
require_once __DIR__ . '/vendor/autoload.php';

// Include database connection
include("../include/connect.php");

// Use mPDF namespace
use Mpdf\Mpdf;

// Get form data (assuming the form is submitted via POST)
$department = isset($_POST['department']) ? $_POST['department'] : '';
$studentNameBangla = isset($_POST['studentNameBangla']) ? $_POST['studentNameBangla'] : '';
$studentNameEnglish = isset($_POST['studentNameEnglish']) ? $_POST['studentNameEnglish'] : '';
$fatherName = isset($_POST['fatherName']) ? $_POST['fatherName'] : '';
$motherName = isset($_POST['motherName']) ? $_POST['motherName'] : '';
$currentSemester = isset($_POST['currentSemester']) ? $_POST['currentSemester'] : '';
$readmissionSemester = isset($_POST['readmissionSemester']) ? $_POST['readmissionSemester'] : '';
$examRoll = isset($_POST['examRoll']) ? $_POST['examRoll'] : '';
$mobileNumber = isset($_POST['mobileNumber']) ? $_POST['mobileNumber'] : '';
$courseDetails = isset($_POST['courseDetails']) ? json_encode($_POST['courseDetails']) : '';
$declaration = isset($_POST['declaration']) ? $_POST['declaration'] : '';
$date = isset($_POST['date']) ? $_POST['date'] : '';
$signature = isset($_POST['signature']) ? $_POST['signature'] : '';

// Prepare and execute SQL query to insert form data into the database
$sql = "INSERT INTO imp_form (department, student_name_bangla, student_name_english, father_name, mother_name, current_semester, readmission_semester, exam_roll, mobile_number, course_details, declaration, date, signature)
        VALUES ('$department', '$studentNameBangla', '$studentNameEnglish', '$fatherName', '$motherName', '$currentSemester', '$readmissionSemester', '$examRoll', '$mobileNumber', '$courseDetails', '$declaration', '$date', '$signature')";

if ($conn->query($sql) === TRUE) {
    // Database insertion successful, proceed with PDF generation

    // Create a new mPDF instance with Bengali font support
    $pdf = new Mpdf([
        'fontdata' => [
            'notosansbengali' => [
                'R' => 'NotoSansBengali-Regular.ttf',
                'B' => 'NotoSansBengali-Bold.ttf',
            ]
        ]
    ]);

    // Set some content to display in the PDF
    $html = '
    <!DOCTYPE html>
    <html>
    <head>
        <title>Form Submission PDF</title>
        <style>
            /* Define your CSS styles here */
            body {
                font-family: \'Noto Sans Bengali\', sans-serif;
                font-size: 12px;
            }
            h1 {
                font-size: 16px;
                margin-bottom: 10px;
            }
            /* Add more styles as needed */
        </style>
    </head>
    <body>
        <div style="text-align: center;">
            <h3 style="margin-bottom: -10px;">পরীক্ষা নিয়ন্ত্রক দপ্তর</h3>
            <img src="./img/jkkniu.jpg" style="vertical-align: middle; height: 100px; width: auto;">
        </div>
        <hr style="border-top: 2px solid;">
        <h3 style="text-align: center;">ফলোন্নয়ন/এফ গ্রেড থেকে উন্নয়ন পরীক্ষার অনুমোদনের আবেদন ফরম</h3>
        <div class="card">
            <div class="card-body">
                <p>বিভাগ: ' . $department . '</p>
                <p>নাম (বাংলা): ' . $studentNameBangla . '</p>
                <p>নাম (ইংরেজি): ' . $studentNameEnglish . '</p>
                <!-- Add more form fields as needed -->
            </div>
        </div>
    </body>
    </html>
    ';

    // Write HTML to PDF
    $pdf->WriteHTML($html);

    // Output PDF
    $pdf->Output('form_submission.pdf', 'D'); // 'D' for force download, 'I' for inline display, 'F' for save to file

    // Exit script
    exit;
} else {
    // Database insertion failed, display error message
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>
