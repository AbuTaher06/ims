<?php
// Include TCPDF library
require_once('../vendor/autoload.php');

// Create a new TCPDF instance
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Add a Bengali Unicode font (replace 'path_to_font' with the actual path to your font file)
$fontpath = TCPDF_FONTS::addTTFfont('Kalpurush.ttf', 'TrueTypeUnicode', '', 96);

// Set the Bengali Unicode font as the default font
$pdf->SetFont('Kalpurush', '', 12);

// Enable font subsetting
$pdf->setFontSubsetting(false); // Set to false for troubleshooting

// Add a page
$pdf->AddPage();

// Set some content to display in the PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Form Submission PDF</title>
    <style>
        /* Define your CSS styles here */
        body {
            font-family: Kalpurush, Arial, sans-serif; /* Use Kalpurush as primary font */
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
            <!-- Include your form content here -->
            <p>Department: ' . $_POST['department'] . '</p>
            <p>Name (Bangla): ' . $_POST['studentNameBangla'] . '</p>
            <p>Name (English): ' . $_POST['studentNameEnglish'] . '</p>
            <!-- Add more form fields as needed -->
        </div>
    </div>
</body>
</html>
';

// Output the HTML content to the PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Close and output PDF document
$pdf->Output('form_submission.pdf', 'D'); // 'D' for force download, 'I' for inline display, 'F' for save to file

// Exit script
exit;
?>
