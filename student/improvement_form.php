<?php 
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- Include jQuery (for AJAX submission) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 
    <style>
          body, html {
            height: 100%;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        /* Hide the submit button text */
        .hide-button {
            display: none;
        }
    </style>
<body style="font-family: 'Noto Sans Bengali UI', sans-serif;">
<?php
include("../include/connect.php");
$uname=$_SESSION['students'];
if (isset($_POST['submit'])) {
    // Extract form data
    $department = $_POST['department'];
    $studentNameBangla = $_POST['studentNameBangla'];
    $studentNameEnglish = $_POST['studentNameEnglish'];
    $fatherName = $_POST['fatherName'];
    $motherName = $_POST['motherName'];
    $currentSemester = $_POST['currentSemester'];

    $readmissionSemester = isset($_POST['readmissionSemester']) ? $_POST['readmissionSemester'] : null;
    $examRoll = isset($_POST['examRoll']) ? $_POST['examRoll'] : null;
    $mobileNumber = isset($_POST['mobileNumber']) ? $_POST['mobileNumber'] : null;
    $courseDetails = json_encode($_POST['courseDetails']); // Convert course details to JSON
    $date = isset($_POST['date']) ? $_POST['date'] : '';

    // Check if the photo file is uploaded
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $photo = $_FILES['photo']['tmp_name']; // Temporary path of uploaded photo
        $photoData = file_get_contents($photo);
        $photoData = addslashes($photoData); // Escape special characters in photo data
    } else {
        // Handle the error or set a default value
        $photoData = null;
    }

    // Access examType from courseDetails
    $courseDetailsArray = $_POST['courseDetails'];
    $examType = json_encode(array_column($courseDetailsArray, 'examType'));
    $selectedYear = json_encode(array_column($courseDetailsArray, 'year'));
    $selectedSemester = json_encode(array_column($courseDetailsArray, 'semester'));

    // Prepare SQL statement to insert data into the database
    $sql = "INSERT INTO imp_form(
        department, student_name_bangla, student_name_english, father_name, mother_name, current_semester, readmission_semester, exam_roll, mobile_number, course_details, date, photo, signature, exam_type
    ) VALUES (
        '$department', '$studentNameBangla', '$studentNameEnglish', '$fatherName', '$motherName', '$currentSemester', '$readmissionSemester', '$examRoll', '$mobileNumber', '$courseDetails', '$date', '$photoData', '$signature', '$examType'
    )";

    // Execute the statement
    $result = mysqli_query($conn, $sql);
    if ($result) {
        // Data inserted successfully
        echo "<script>alert('Form submitted successfully');</script>";
        // Optionally, you can redirect the user to another page after successful submission
        header("Location: show.php");
    } else {
        // Error occurred
        echo "<script>alert('Error submitting form');</script>";
        echo "Error: " . mysqli_error($conn); // Print MySQL error message for debugging
    }
}
?>
<div style="text-align: center;">
    <h4 style="margin-bottom: -6px;">পরীক্ষা নিয়ন্ত্রক দপ্তর</h4>
    <div style="display: inline-block;">
        <img src="./img/jkkniu.png" style="vertical-align: middle; height: 100px; width: auto;">
    </div>
    <div style="display: inline-block; vertical-align: middle;">
        <h3 style="padding: 0;">জাতীয় কবি কাজী নজরুল ইসলাম বিশ্ববিদ্যালয়</h3>
        <h3 style="padding: 0;">ত্রিশাল, ময়মনসিংহ  ২২২৪</h3>
    </div>
</div>
<hr style="border-top: 2px solid;">
<h4 style="text-align: center;">ফলোন্নয়ন/এফ গ্রেড থেকে উন্নয়ন পরীক্ষার অনুমোদনের আবেদন ফরম</h4>

                <div class="card-body">
    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
        <div class="card">
                <div class="card-body">
            <h3 class="text-center mb-4">পরীক্ষার্থী কর্তৃক পূরণীয়</h3>

            <form id="submissionForm" action="" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="department" class="form-label">১। বিভাগ:</label>
                    <input type="text" class="form-control" id="department" name="department" placeholder="আপনার বিভাগ লিখুন" required>
                </div>
                <div class="mb-3">
                    <label for="studentNameBangla" class="form-label">২। ক) নাম (বাংলা):</label>
                    <input type="text" class="form-control" id="studentNameBangla" name="studentNameBangla" placeholder="আপনার বাংলা নাম লিখুন" required>
                </div>
                <div class="mb-3">
                    <label for="studentNameEnglish" class="form-label">  খ) নাম (ইংরেজি):</label>
                    <input type="text" class="form-control" id="studentNameEnglish" name="studentNameEnglish" placeholder="আপনার ইংরেজি নাম লিখুন" required>
                </div>
                <div class="mb-3">
                    <label for="fatherName" class="form-label">৪। পিতার নাম:</label>
                    <input type="text" class="form-control" id="fatherName" name="fatherName" placeholder="আপনার পিতার নাম লিখুন" required>
                </div>
                <div class="mb-3">
                    <label for="motherName" class="form-label">৫। মাতার নাম:</label>
                    <input type="text" class="form-control" id="motherName" name="motherName" placeholder="আপনার মাতার নাম লিখুন" required>
                </div>
                <input type="hidden" id="nextSession" name="nextSession">
                <div class="mb-3">
    <label for="currentSession" class="form-label">৬। বর্তমান শিক্ষাবর্ষ:</label>
    <select class="form-select" id="currentSession" name="currentSession" required onchange="updatenextSession()">
        <option selected disabled>বর্তমান শিক্ষাবর্ষ নির্বাচন করুন</option>
        <option value="2018-19">2018-2019</option>
        <option value="2019-20">2019-2020</option>
        <option value="2020-21">2020-2021</option>
        <option value="2021-22">2021-2022</option>
        <option value="2022-23">2022-2023</option>
        <option value="2023-24">2023-2024</option>
    </select>
</div>

<!-- Add a hidden input field to store the previous session -->
<input type="hidden" id="nextSession" name="nextSession">
   


<div class="mb-3">
    <label for="currentSemester" class="form-label">৬। বর্তমান সেমিস্টার:</label>
    <input type="text" class="form-control" id="currentSemester" name="currentSemester" placeholder="আপনার বর্তমান  সেমিস্টার লিখুন" required>
</div>

                <div class="mb-3">
                    <label for="readmissionSemester" class="form-label">৭। পুনঃ ভর্তি হলে, শিক্ষাবর্ষ ও সেমিস্টার লিখুন (যদি প্রযোজ্য হয়):</label>
                    <input type="text" class="form-control" id="readmissionSemester" name="readmissionSemester" placeholder="পুনঃ ভর্তি হলে শিক্ষাবর্ষ ও সেমিস্টার লিখুন (যদি প্রযোজ্য হয়)">
                </div>
                <div class="mb-3">
                    <label for="examRoll" class="form-label">৮। পরীক্ষার রোল নম্বর:</label>
                    <input type="text" class="form-control" id="examRoll" name="examRoll" placeholder="আপনার পরীক্ষার রোল নম্বর লিখুন">
                </div>
                <div class="mb-3">
                    <label for="mobileNumber" class="form-label">৯। মোবাইল নম্বর:</label>
                    <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" placeholder="আপনার মোবাইল নম্বর লিখুন">
                </div>
                <div class="mb-3">
                            <label for="publish_date" class="form-label">সংশ্লিষ্ট পরীক্ষার ফলাফল প্রকাশের তারিখ:</label>
                            <input type="date" class="form-control" id="publish_date" name="publish_date" required>
                        </div>
                <div class="mb-3">
    <label for="courseDetails" class="form-label">১০। যে সকল কোর্সে ফলোন্নয়ন/এফ গ্রেড থেকে উন্নয়ন পরীক্ষায় অংশগ্রহণ করতে ইচ্ছুক তার বিবরণ:</label>
    <table class="table table-bordered">
    <thead>
        <tr class="bg-primary text-white">
            <th scope="col">ক্রমিক নং</th>
            <th scope="col">বর্ষ</th>
            <th scope="col">সেমিস্টার</th>
            <th scope="col">কোর্স কোড</th>
            <th scope="col">কোর্স ক্রেডিট</th>
            <th scope="col">কোর্স শিরোনাম</th>
            <th scope="col">প্রাপ্ত জিপিএ</th>
            <th scope="col">পরীক্ষার ধরণ</th>
        </tr>
    </thead>
    <tbody>
                        <tr>
                            <td><input type="number" class="form-control" name="courseDetails[0][serialNo]" required></td>
                            <td><input type="text" class="form-control" name="courseDetails[0][year]" onchange="updateSelectedYear(this.value)" required></td>
                            <td><input type="text" class="form-control" name="courseDetails[0][semester]"></td>
                            <td><input type="text" class="form-control" name="courseDetails[0][courseCode]"></td>
                            <td><input type="text" class="form-control" name="courseDetails[0][courseCredit]"></td>
                            <td><input type="text" class="form-control" name="courseDetails[0][courseTitle]"></td>
                            <td><input type="text" class="form-control" name="courseDetails[0][gpaObtained]"></td>
                            <td>
                                <select class="form-select" name="courseDetails[0][examType]" required>
                                    <option value="" disabled selected>Select Exam Type</option>
                                    <option value="Improvement">Improvement</option>
                                    <option value="Fail">Fail</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><input type="number" class="form-control" name="courseDetails[1][serialNo]"></td>
                            <td><input type="text" class="form-control" name="courseDetails[1][year]"></td>
                            <td><input type="text" class="form-control" name="courseDetails[1][semester]"></td>
                            <td><input type="text" class="form-control" name="courseDetails[1][courseCode]"></td>
                            <td><input type="text" class="form-control" name="courseDetails[1][courseCredit]"></td>
                            <td><input type="text" class="form-control" name="courseDetails[1][courseTitle]"></td>
                            <td><input type="text" class="form-control" name="courseDetails[1][gpaObtained]"></td>
                            <td>
                                <select class="form-select" name="courseDetails[1][examType]">
                                    <option value="" disabled selected>Select Exam Type</option>
                                    <option value="Improvement">Improvement</option>
                                    <option value="Fail">Fail</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
</table>
<input type="hidden" id="selectedYear" name="selectedYear">

</div>

                <div class="mb-3">
                    <label for="declaration" class="form-label">বিনীত নিবেদক:</label>
                   
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="mb-3">
                    <label for="photo" class="form-label">ছবি (স্বাক্ষর):</label>
                    <input type="file" class="form-control" id="photo" name="photo" accept="image/*" required>
                </div>

                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="date" class="form-label">তারিখ:</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>
                    </div>
</div>
<input type="submit" class="form-control btn btn-primary" id="submit" name="submit" value="submit">
<hr>
<?php 

// Assuming $conn is your database connection
//$uname = $_SESSION['uname']; // Assuming the username is stored in the session
$q = "SELECT * FROM imp_form WHERE student_name_english='$uname'"; // Query to select all data from imp_form table
$result = mysqli_query($conn, $q); // Execute the query
?>

<div class="mb-3">
    <h2>সংশ্লিষ্ট বিভাগ কর্তৃক পূরণীয়:</h2>
    <?php
    // Initialize counters outside the if statement
    $improvementCount = 0; // Counter for Improvement courses
    $failCount = 0; // Counter for Fail courses

    // Check if there are any results returned from the query
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Check if course_details is not null
            if (!is_null($row['course_details'])) {
                $courseDetails = json_decode($row['course_details'], true);
                
                // Iterate through the courses and count the exam types
                foreach ($courseDetails as $course) {
                    if (isset($course['examType'])) { // Check if examType key exists
                        if ($course['examType'] === 'Improvement') {
                            $improvementCount++;
                        } elseif ($course['examType'] === 'Fail') {
                            $failCount++;
                        }
                    }
                }
            }
        }
    }

    // Display the data
    echo "<p>";
    echo "১। আবেদনকারী এ পর্যন্ত সর্বমোট কয়টি কোর্স এ এফ গ্রেড থেকে উন্নয়ন এবং ফলোন্নয়ন পরীক্ষায় অংশগ্রহণ করেছে:";
    echo "<br>ক) এফ গ্রেড থেকে উন্নয়ন " . $failCount . " টি কোর্স,";
    echo "<br>(খ) ফলোন্নয়ন " . $improvementCount . " টি কোর্স";
    echo "</p>";
?>

</div>


<?php

   // Retrieve the course details from the POST request
$courseDetails = isset($_POST['courseDetails']) ? $_POST['courseDetails'] : "";
$selectedYear = isset($courseDetails[1]['year']) ? $courseDetails[1]['year'] : ""; // Assuming you're retrieving the year for the second course

$selectedSemester = '2'; // Assuming we are checking the 2nd semester for the given year

$improvementCount = 0; // Counter for Improvement courses
$failCount = 0; // Counter for Fail courses

// Process the course details to count the exam types for the selected year and first semester
foreach ($courseDetails as $course) {
    if (isset($course['examType']) && isset($course['year']) && isset($course['semester'])) {
        if ($course['year'] === $selectedYear && $course['semester'] === '1') {
            if ($course['examType'] === 'Improvement') {
                $improvementCount++;
            } elseif ($course['examType'] === 'Fail') {
                $failCount++;
            }
        }
    }
}


    // Display the second paragraph dynamically based on the selected year and first semester
    echo "<p>";
    echo "২। যে বর্ষের ২য় সেমিস্টার পরীক্ষায় এফ গ্রেড থেকে উন্নয়ন ও ফলোন্নয়ন পরীক্ষায় অংশগ্রহণ করতে ইচ্ছুক শিক্ষার্থী উক্ত বর্ষের ১ম সেমিস্টার পরীক্ষায় কয়টি কোর্সে এফ গ্রেড থেকে উন্নয়ন এবং ফলোন্নয়ন পরীক্ষায় অংশগ্রহণ করেছে:";
    echo "<br>ক) এফ গ্রেড থেকে উন্নয়ন " . $failCount . " টি কোর্স,";
    echo "<br>(খ) ফলোন্নয়ন " . $improvementCount . " টি কোর্স";
    echo "</p>";

?>



<!-- <p>
    ২। যে বর্ষের ২য় সেমিস্টার পরীক্ষায় এফ গ্রেড থেকে উন্নয়ন ও ফলোন্নয়ন পরীক্ষায় অংশগ্রহণ করতে ইচ্ছুক শিক্ষার্থী উক্ত বর্ষের ১ম সেমিস্টার পরীক্ষায় কয়টি কোর্সে এফ গ্রেড থেকে উন্নয়ন এবং ফলোন্নয়ন পরীক্ষায় অংশগ্রহণ করেছে:<br>
    ক) এফ গ্রেড থেকে উন্নয়ন ...........................টি কোর্স,<br>
    (খ) ফলোন্নয়ন .......................................টি কোর্স
  </p> -->
<?php 
$currentSession = isset($_POST['currentSession']) ? $_POST['currentSession'] : "";
$startingYear = (int)substr($currentSession, 0, 4);
$nextStartingYear = $startingYear + 1;
$nextEndingYear = $nextStartingYear + 1;
$nextSession = $nextStartingYear . '-' . $nextEndingYear;

?>

<!-- Your PHP code to calculate the previous session -->
<p id="nextSessionDisplay">
        ৩। বিশ্ববিদ্যালয়ের বিধি মোতাবেক পরবর্তী সম্ভাব্য নিকটতম যে শিক্ষাবর্ষের সাথে ফলোন্নয়ন/এফ গ্রেড থেকে উন্নয়ন পরীক্ষায় অংশগ্রহণ করতে পারবে তার শিক্ষাবর্ষ: 
        <span id="nextSessionValue"><?php echo $nextSession; ?></span>
    </p>
    <p>
    <p id="publish_date_display">
    <?php
        $date = isset($_POST['publish_date']) ? $_POST['publish_date'] : '';
        if (!empty($date)) {
            echo "৪| সংশ্লিষ্ট পরীক্ষার ফলাফল প্রকাশের তারিখ: " . $date . " / খ্রি:";
        }
    ?>
<!-- </p>

    অফিস সহকারী/কর্মকর্তার স্বাক্ষর:<br>
    বিভাগীয় প্রধানের সুপারিশসহ স্বাক্ষর ও সিল
  </p> -->

  </div>

</div>
  <div class="row no-print">
                <div class="col-12">
                  <!-- <a href="invoice-print.php" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </button> -->
                  <button type="button" class="btn btn-primary float-right" onclick="window.print()" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>
                </div>
              </div>
<!-- Your PHP code to calculate the previous session -->
<!-- <div class="text-center">
                        <button class="btn btn-primary" onclick="window.print()">Print</button>
                    </div> -->

<!-- Rest of your HTML form -->


<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- AJAX Script to Submit Form and Generate PDF -->
<script>
    function updatenextSession() {
        var currentSession = document.getElementById("currentSession").value;
        var currentSessionParts = currentSession.split("-");
        var startingYear = parseInt(currentSessionParts[0]);
        var nextYear = startingYear + 1;
        var nextSession = nextYear + '-' + (nextYear + 1);
        document.getElementById("nextSession").value = nextSession;
        document.getElementById("nextSessionValue").textContent = nextSession;
    }

    const publishDateInput = document.getElementById('publish_date');
    // Get the paragraph element to display the date
    const publishDateDisplay = document.getElementById('publish_date_display');

    // Add an event listener to the input element
    publishDateInput.addEventListener('input', function() {
        // Get the value of the input element (publish date)
        const publishDate = this.value;

        // Update the content of the paragraph element with the publish date
        publishDateDisplay.textContent = `৪| সংশ্লিষ্ট পরীক্ষার ফলাফল প্রকাশের তারিখ: ${publishDate} / খ্রি:`;
    });
  
</script>
</body>
</html>