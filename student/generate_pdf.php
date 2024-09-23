<?php
session_start();
require '../vendor/autoload.php'; // Include DOMPDF autoloader
use Dompdf\Dompdf;
use Dompdf\Options;

include("../include/connect.php"); // Include your database connection file

// Fetch data from the session or database
$uname = $_SESSION['student'];

// Query to select data from the database
$q = "SELECT * FROM imp_form WHERE email='$uname'";
$result = mysqli_query($conn, $q);
$row = mysqli_fetch_assoc($result);

// Prepare DOMPDF
$options = new Options();
$options->set('defaultFont', 'Courier');
$dompdf = new Dompdf($options);

// Create HTML content
$html = "
<!DOCTYPE html>
<html lang='bn'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>PDF Document</title>
    <style>
        body { font-family: 'Noto Sans Bengali UI', sans-serif; }
        h4, h3, h2 { text-align: center; }
        hr { border-top: 2px solid; }
    </style>
</head>
<body>
    <div style='text-align: center;'>
        <h4 style='margin-bottom: -6px;'>পরীক্ষা নিয়ন্ত্রক দপ্তর</h4>
        <div style='display: inline-block;'>
            <img src='./img/jkkniu.png' style='vertical-align: middle; height: 100px; width: auto;'>
        </div>
        <div style='display: inline-block; vertical-align: middle;'>
            <h3 style='padding: 0;'>জাতীয় কবি কাজী নজরুল ইসলাম বিশ্ববিদ্যালয়</h3>
            <h3 style='padding: 0;'>ত্রিশাল, ময়মনসিংহ 2224</h3>
        </div>
    </div>
    <hr>
    <h4>ফলোন্নয়ন/এফ গ্রেড থেকে উন্নয়ন পরীক্ষার অনুমোদনের আবেদন ফরম</h4>
    
    <h3 class='text-center mb-4'>পরীক্ষার্থী কর্তৃক পূরণীয়</h3>
    
    <p>১। বিভাগ: {$row['department']}</p>
    <p>২। নাম (বাংলা): {$row['student_name_bangla']}</p>
    <p>৩। নাম (ইংরেজি): {$row['student_name_english']}</p>
    <p>৪। পিতার নাম: {$row['father_name']}</p>
    <p>৫। মাতার নাম: {$row['mother_name']}</p>
    <p>৬। বর্তমান সেমিস্টার: {$row['current_semester']}</p>
    <p>৭। পুনঃ ভর্তি হলে, শিক্ষাবর্ষ ও সেমিস্টার: {$row['readmission_semester']}</p>
    <p>৮। পরীক্ষার রোল নম্বর: {$row['exam_roll']}</p>
    <p>৯। মোবাইল নম্বর: {$row['mobile_number']}</p>
    <p>১০। তারিখ: {$row['date']}</p>
    
    <h2>সংশ্লিষ্ট বিভাগ কর্তৃক পূরণীয়:</h2>
    <p>১। আবেদনকারী এ পর্যন্ত সর্বমোট কয়টি কোর্স এ এফ গ্রেড থেকে উন্নয়ন এবং ফলোন্নয়ন পরীক্ষায় অংশগ্রহণ করেছে:</p>
    <p>ক) এফ গ্রেড থেকে উন্নয়ন {$row['improvementCount']} টি কোর্স,</p>
    <p>(খ) ফলোন্নয়ন {$row['failCount']} টি কোর্স</p>
    
    <p>২। যে বর্ষের ২য় সেমিস্টার পরীক্ষায় এফ গ্রেড থেকে উন্নয়ন ও ফলোন্নয়ন পরীক্ষায় অংশগ্রহণ করতে ইচ্ছুক শিক্ষার্থী উক্ত বর্ষের ১ম সেমিস্টার পরীক্ষায় কয়টি কোর্সে এফ গ্রেড থেকে উন্নয়ন এবং ফলোন্নয়ন পরীক্ষায় অংশগ্রহণ করেছে:</p>
    <p>ক) এফ গ্রেড থেকে উন্নয়ন {$row['failCount']} টি কোর্স,</p>
    <p>(খ) ফলোন্নয়ন {$row['improvementCount']} টি কোর্স</p>
    
    <p>৩। বিশ্ববিদ্যালয়ের বিধি মোতাবেক পরবর্তী সম্ভাব্য নিকটতম যে শিক্ষাবর্ষের সাথে ফলোন্নয়ন/এফ গ্রেড থেকে উন্নয়ন পরীক্ষায় অংশগ্রহণ করতে পারবে তার শিক্ষাবর্ষ: <span>{$nextSession}</span></p>
</body>
</html>
";

// Load HTML content
$dompdf->loadHtml($html);
// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');
// Render the HTML as PDF
$dompdf->render();
// Output the generated PDF to Browser
$dompdf->stream("application_form.pdf", array("Attachment" => false));
?>
