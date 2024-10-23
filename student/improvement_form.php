<?php
session_start();
$pageTitle = "Submit";
include("header.php"); // Include header file
include("sidebar.php"); // Include sidebar file
include("../include/connect.php");
?>
 
    <style>
 body, html {
    height: 100%;
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
}

.container {
    padding: 20px;
}

.form-control, .form-select {
    width: 100%; /* Full width for inputs */
    padding: 8px;
    box-sizing: border-box; /* Ensure padding doesn't affect width */
}

.table {
    width: 100%; /* Full width for the table */
    margin-bottom: 20px; /* Space below the table */
}

@media screen and (max-width: 768px) {
    .container {
        padding: 15px;
    }

    .form-control, .form-select {
        min-width: unset; /* Remove minimum width for smaller screens */
    }
}

@media screen and (max-width: 480px) {
    .container {
        padding: 10px;
    }

    .form-control, .form-select {
        font-size: 14px; /* Adjust font size for smaller screens */
    }
}
    </style>
<body style="font-family: 'Noto Sans Bengali UI', sans-serif;">
<?php
include("../include/connect.php");
$uname=$_SESSION['student'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_SESSION["student"];
    
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
    $courseDetails = $_POST['courseDetails']; // Array of course details
    $date = isset($_POST['date']) ? $_POST['date'] : '';

    // Calculate total credits for Improvement courses
    $totalImprovementCredits = 0;
    foreach ($courseDetails as $course) {
        if ($course['examType'] === 'Improvement') {
            $totalImprovementCredits += (float)$course['courseCredit'];
        }
    }

    // Check if total Improvement credits exceed 6
    if ($totalImprovementCredits > 6) {
        echo "<script>alert('Improvement not allowed: Total Improvement credits exceed 6');</script>";
    } else {
        // Convert course details to JSON for database storage
        $courseDetailsJson = json_encode($courseDetails);

        // Prepare SQL statement to insert data into the database
        $sql = "INSERT INTO imp_form (
            department, email, student_name_bangla, student_name_english, father_name, mother_name, current_semester, 
            readmission_semester, exam_roll, mobile_number, course_details, date
        ) VALUES (
            ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW()
        )";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sssssssssss",
            $department, $email, $studentNameBangla, $studentNameEnglish, $fatherName, $motherName, 
            $currentSemester, $readmissionSemester, $examRoll, $mobileNumber, $courseDetailsJson
        );

        if ($stmt->execute()) {
            echo "<script>alert('Form submitted successfully');</script>";
            header("Location: show.php");
        } else {
            echo "<script>alert('Error submitting form');</script>";
            echo "Error: " . mysqli_error($conn); // Print MySQL error message for debugging
        }

        $stmt->close();
    }
}
?>
<main id="main" class="main">
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
    
            <h3 class="text-center mb-4">পরীক্ষার্থী কর্তৃক পূরণীয়</h3>

            <div class="container">
            <div class="container">
    <form id="submissionForm" action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="department" class="form-label">১। বিভাগ:</label>
            <select class="form-select" id="department" name="department" required>
                    <option selected disabled>Select your department</option>
                    <option value="COMPUTER SCIENCE AND ENGINEERING">Computer Science and Engineering</option>
                    <option value="ELECTRICAL AND ELECTRONIC ENGINEERING">Electrical and Electronic Engineering</option>
                    <option value="ENVIRONMENTAL SCIENCE AND ENGINEERING">Environmental Science and Engineering</option>
                    <option value="STATISTICS">Statistics</option>
                    <option value="BANGLA LANGUAGE AND LITERATURE">Bangla Language and Literature</option>
                    <option value="ENGLISH LANGUAGE AND LITERATURE">English Language and Literature</option>
                    <option value="ECONOMICS">Economics</option>
                    <option value="PUBLIC ADMINISTRATION AND GOVERNANCE STUDIES">Public Administration and Governance Studies</option>
                    <option value="FOLKLORE">Folklore</option>
                    <option value="LAW AND JUSTICE">Law and Justice</option>
                    <option value="ANTHROPOLOGY">Anthropology</option>
                    <option value="POPULATION SCIENCE">Population Science</option>
                    <option value="LOCAL GOVERNMENT AND URBAN DEVELOPMENT">Local Government and Urban Development</option>
                    <option value="PHILOSOPHY">Philosophy</option>
                    <option value="SOCIOLOGY">Sociology</option>
                    <option value="HISTORY">History</option>
                    <option value="MUSIC">Music</option>
                    <option value="FINE ARTS">Fine Arts</option>
                    <option value="THEATRE AND PERFORMANCE STUDIES">Theatre and Performance Studies</option>
                    <option value="FILM AND MEDIA STUDIES">Film and Media Studies</option>
                    <option value="ACCOUNTING AND INFORMATION SYSTEMS">Accounting and Information Systems</option>
                    <option value="FINANCE AND BANKING">Finance and Banking</option>
                    <option value="HUMAN RESOURCE MANAGEMENT">Human Resource Management</option>
                    <option value="MANAGEMENT">Management</option>
                    <option value="MARKETING">Marketing</option>
                </select>
        </div>

        <div class="mb-3">
    <label class="form-label">২। নাম:</label>
    
    <!-- Subsection for Bangla name -->
    <div style="margin-left: 20px; margin-top: 10px;">
        <label for="studentNameBangla" class="form-label"> ক) নাম (বাংলা):</label>
        <input type="text" class="form-control" id="studentNameBangla" name="studentNameBangla" placeholder="আপনার বাংলা নাম লিখুন" required>
    </div>

    <!-- Subsection for English name -->
    <div style="margin-left: 20px; margin-top: 10px;">
        <label for="studentNameEnglish" class="form-label">খ) নাম (ইংরেজি):</label>
        <input type="text" class="form-control" id="studentNameEnglish" name="studentNameEnglish" placeholder="আপনার ইংরেজি নাম লিখুন" required>
    </div>
</div>


        <div class="mb-3">
            <label for="fatherName" class="form-label">৩। পিতার নাম:</label>
            <input type="text" class="form-control" id="fatherName" name="fatherName" placeholder="আপনার পিতার নাম লিখুন" required>
        </div>

        <div class="mb-3">
            <label for="motherName" class="form-label">৪। মাতার নাম:</label>
            <input type="text" class="form-control" id="motherName" name="motherName" placeholder="আপনার মাতার নাম লিখুন" required>
        </div>

        <div class="mb-3">
        <label for="currentSession" class="form-label">৫। বর্তমান শিক্ষাবর্ষ:</label>
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

        <div class="mb-3">
            <label for="currentSemester" class="form-label">৬। বর্তমান সেমিস্টার:</label>
            <select class="form-select" id="currentSemester" name="currentSemester" required>
                <option value="" disabled selected>আপনার বর্তমান সেমিস্টার নির্বাচন করুন</option>
                <option value="1st">1st</option>
                <option value="2nd">2nd</option>
                    <option value="3rd">3rd</option>
                    <option value="4th">4th</option>
                    <option value="5th">5th</option>
                    <option value="6th">6th</option>
                    <option value="7th">7th</option>
                    <option value="8th">8th</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="readmissionSemester" class="form-label">৭। পুনঃ ভর্তি হলে, শিক্ষাবর্ষ ও সেমিস্টার লিখুন (যদি প্রযোজ্য হয়):</label>
            <input type="text" class="form-control" id="readmissionSemester" name="readmissionSemester" placeholder="Example: 2019-2020 & 3rd">
            <div id="error-message" class="text-danger" style="display: none;">দয়া করে সঠিক ফরম্যাটে লিখুন (যেমন: 2019-2020 & 3rd).</div>
        </div>

        <div class="mb-3">
            <label for="examRoll" class="form-label">৮। পরীক্ষার রোল নম্বর:</label>
            <input type="text" class="form-control" id="examRoll" name="examRoll" placeholder="আপনার পরীক্ষার রোল নম্বর লিখুন">
        </div>

        <div class="mb-3">
            <label for="mobileNumber" class="form-label">৯। মোবাইল নম্বর:</label>
            <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" placeholder="আপনার মোবাইল নম্বর লিখুন" required>
            <div id="phone-error-message" class="text-danger" style="display: none;">দয়া করে সঠিক মোবাইল নম্বর লিখুন (যেমন: 01XXXXXXXXX).</div>
        </div>

        <div class="mb-3">
            <label for="publish_date" class="form-label">সংশ্লিষ্ট পরীক্ষার ফলাফল প্রকাশের তারিখ:</label>
            <input type="date" class="form-control" id="publish_date" name="publish_date" required>
        </div>

        <label for="courseDetails" class="form-label">১০। যে সকল কোর্সে ফলোন্নয়ন/এফ গ্রেড থেকে উন্নয়ন পরীক্ষায় অংশগ্রহণ করতে ইচ্ছুক তার বিবরণ:</label>
      
    <table class="table table-bordered" id="courseTable">
    <thead>
    <div class="mb-3">
        <label for="totalCredits" class="form-label">Total Credits:</label>
        <input type="text" class="form-control" id="totalCredits" name="totalCredits" readonly>
    </div>

        <tr class="bg-primary text-white">
            <th scope="col">ক্রমিক নং</th>
            <th scope="col">বর্ষ</th>
            <th scope="col">সেমিস্টার</th>
            <th scope="col">কোর্স কোড</th>
            <th scope="col">কোর্স ক্রেডিট</th>
            <th scope="col">কোর্স শিরোনাম</th>
            <th scope="col">প্রাপ্ত জিপিএ</th>
            <th scope="col">পরীক্ষার ধরণ</th>
            <th scope="col"><button type="button" class="btn btn-success" id="addRowBtn">Add New Row</button></th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><input type="number" class="form-control" name="courseDetails[0][serialNo]" value="1" readonly></td>
            <td>
                <select class="form-select" name="courseDetails[0][year]" required>
                    <option value="" disabled selected>Select Year</option>
                    <option value="1">১ম</option>
                    <option value="2">২য়</option>
                    <option value="3">৩য়</option>
                    <option value="4">৪র্থ</option>
                </select>
            </td>
            <td>
                <select class="form-select" name="courseDetails[0][semester]" required>
                    <option value="" disabled selected>Select Semester</option>
                    <option value="1">১ম</option>
                    <option value="2">২য়</option>
                </select>
            </td>

            <!-- Populate dropdowns with initial values from PHP -->
            <td>
                <select class="form-select" name="courseDetails[0][courseCode]" required id="courseCodeSelect">
                    <option value="" disabled selected>Select Course Code</option>
                    <?php 
                    $student_info = "SELECT * FROM students WHERE email='$uname'";
                    $result_info = mysqli_query($conn, $student_info);
                    $student_row = mysqli_fetch_assoc($result_info);
                    $dept = $student_row['department'];

                    $course_info = "SELECT DISTINCT course_code,course_title,course_credit FROM courses WHERE dept_name='$dept'";
                    $result = mysqli_query($conn, $course_info);

                    while ($course_row = mysqli_fetch_assoc($result)) {
                        $course_code = $course_row['course_code'];
                        echo '<option value="' . $course_code . '">' . $course_code . '</option>';
                    }
                    ?>
                </select>
            </td>
            <td>
                <select class="form-select" name="courseDetails[0][courseCredit]" required id="courseCreditSelect">
                    <option value="" disabled selected>Select Course Credit</option>
                    <?php 
                    mysqli_data_seek($result, 0); // Reset pointer for re-use
                    while ($course_row = mysqli_fetch_assoc($result)) {
                        $course_credit = $course_row['course_credit'];
                        echo '<option value="' . $course_credit . '">' . $course_credit . '</option>';
                    }
                    ?>
                </select>
            </td>
            <td>
                <select class="form-select" name="courseDetails[0][courseTitle]" required id="courseTitleSelect">
                    <option value="" disabled selected>Select Course Title</option>
                    <?php 
                    mysqli_data_seek($result, 0); // Reset pointer for re-use
                    while ($course_row = mysqli_fetch_assoc($result)) {
                        $course_title = $course_row['course_title'];
                        echo '<option value="' . $course_title . '">' . $course_title . '</option>';
                    }
                    ?>
                </select>
            </td>

            <td><input type="number" step="0.01" class="form-control" name="courseDetails[0][gpaObtained]" required min="0" max="2.99" placeholder="Enter GPA (0.00 - 2.99)"></td>
            <td>
                <select class="form-select" name="courseDetails[0][examType]" required>
                    <option value="" disabled selected>Select Exam Type</option>
                    <option value="Improvement">Improvement</option>
                    <option value="Fail">Fail</option>
                </select>
            </td>
            <td><button type="button" class="btn btn-danger removeRowBtn">Remove</button></td>
        </tr>
    </tbody>
</table>
</table>


        <!-- <div id="error-message" class="text-danger" style="display: none;"></div>  
        <input type="hidden" id="selectedYear" name="selectedYear">
            <div class="col-md-6">
            <div class="mb-3">
            <label for="photo" class="form-label">ছবি (স্বাক্ষর):</label>
            <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
        </div>

            </div> -->

        <input type="submit" class="btn btn-primary w-100" value="Submit"> <!-- Full width button -->
    </form>
</div>

</div>

<hr>


</body>

<!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- AJAX Script to Submit Form and Generate PDF -->
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Function to apply GPA validation to all GPA inputs
        function applyGPAValidation() {
            const gpaInputs = document.querySelectorAll('input[name$="[gpaObtained]"]');
            gpaInputs.forEach(input => {
                input.addEventListener('input', (event) => {
                    const value = parseFloat(event.target.value);
                    if (value >= 3.0) {
                        event.target.value = 2.99; // or set to ''
                        alert('GPA must be less than 3.0');
                    }
                });
            });
        }

        // Apply validation to existing GPA inputs
        applyGPAValidation();

// Store the course options in JavaScript arrays for later reuse
const courseCodes = <?php 
        $course_codes = [];
        mysqli_data_seek($result, 0);
        while ($course_row = mysqli_fetch_assoc($result)) {
            $course_codes[] = $course_row['course_code'];
        }
        echo json_encode($course_codes);
    ?>;
    
    const courseCredits = <?php 
        $course_credits = [];
        mysqli_data_seek($result, 0);
        while ($course_row = mysqli_fetch_assoc($result)) {
            $course_credits[] = $course_row['course_credit'];
        }
        echo json_encode($course_credits);
    ?>;

    const courseTitles = <?php 
        $course_titles = [];
        mysqli_data_seek($result, 0);
        while ($course_row = mysqli_fetch_assoc($result)) {
            $course_titles[] = $course_row['course_title'];
        }
        echo json_encode($course_titles);
    ?>;

    // Add new row functionality
    document.getElementById('addRowBtn').addEventListener('click', function() {
        const tableBody = document.querySelector('#courseTable tbody');
        const rowCount = tableBody.rows.length;

        // Build course options dropdown for the new row
        let courseCodeOptions = '<option value="" disabled selected>Select Course Code</option>';
        courseCodes.forEach(code => {
            courseCodeOptions += `<option value="${code}">${code}</option>`;
        });

        let courseCreditOptions = '<option value="" disabled selected>Select Course Credit</option>';
        courseCredits.forEach(credit => {
            courseCreditOptions += `<option value="${credit}">${credit}</option>`;
        });

        let courseTitleOptions = '<option value="" disabled selected>Select Course Title</option>';
        courseTitles.forEach(title => {
            courseTitleOptions += `<option value="${title}">${title}</option>`;
        });

        const newRow = `
            <tr>
                <td><input type="number" class="form-control" name="courseDetails[${rowCount}][serialNo]" value="${rowCount + 1}" readonly></td>
                <td>
                    <select class="form-select" name="courseDetails[${rowCount}][year]" required>
                        <option value="" disabled selected>Select Year</option>
                        <option value="1">১ম</option>
                        <option value="2">২য়</option>
                        <option value="3">৩য়</option>
                        <option value="4">৪র্থ</option>
                    </select>
                </td>
                <td>
                    <select class="form-select" name="courseDetails[${rowCount}][semester]" required>
                        <option value="" disabled selected>Select Semester</option>
                        <option value="1">১ম</option>
                        <option value="2">২য়</option>
                    </select>
                </td>
                <td>
                    <select class="form-select" name="courseDetails[${rowCount}][courseCode]" required>
                        ${courseCodeOptions}
                    </select>
                </td>
                <td>
                    <select class="form-select" name="courseDetails[${rowCount}][courseCredit]" required>
                        ${courseCreditOptions}
                    </select>
                </td>
                <td>
                    <select class="form-select" name="courseDetails[${rowCount}][courseTitle]" required>
                        ${courseTitleOptions}
                    </select>
                </td>
                <td>
                    <input type="number" step="0.01" class="form-control" name="courseDetails[${rowCount}][gpaObtained]" required min="0" max="2.99" placeholder="Enter GPA (0.00 - 2.99)">
                </td>
                <td>
                    <select class="form-select" name="courseDetails[${rowCount}][examType]" required>
                        <option value="" disabled selected>Select Exam Type</option>
                        <option value="Improvement">Improvement</option>
                        <option value="Fail">Fail</option>
                    </select>
                </td>
                <td><button type="button" class="btn btn-danger removeRowBtn">Remove</button></td>
            </tr>
        `;

        tableBody.insertAdjacentHTML('beforeend', newRow);
        applyGPAValidation(); // Reapply GPA validation for new row
    });

    // Remove row functionality
    document.querySelector('#courseTable tbody').addEventListener('click', function(event) {
        if (event.target.classList.contains('removeRowBtn')) {
            event.target.closest('tr').remove();
            updateSerialNumbers();
        }
    });

    // Update serial numbers after removing a row
    function updateSerialNumbers() {
        const rows = document.querySelectorAll('#courseTable tbody tr');
        rows.forEach((row, index) => {
            row.querySelector('input[name*="[serialNo]"]').value = index + 1;
        });
    }

    // Expandable input fields (optional enhancement)
    document.querySelectorAll('#courseTable input[type="text"], #courseTable input[type="number"]').forEach(input => {
        input.addEventListener('input', function() {
            const tempSpan = document.createElement('span');
            document.body.appendChild(tempSpan);
            tempSpan.innerText = this.value || this.placeholder;
            tempSpan.style.fontSize = getComputedStyle(this).fontSize;
            tempSpan.style.visibility = 'hidden';
            tempSpan.style.position = 'absolute';
            const width = tempSpan.offsetWidth + 20; // Add some padding
            this.style.width = `${width}px`;
            document.body.removeChild(tempSpan);
        });
    });


        // Validate readmission semester
        document.getElementById('readmissionSemester').addEventListener('input', function() {
            const input = this.value;
            const pattern = /^\d{4}-\d{4} & \d+(?:[a-zA-Z]+)?$/; // Pattern for "YYYY-YYYY & Xth"

            const errorMessage = document.getElementById('error-message');
            if (!pattern.test(input)) {
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        });

        // Validate mobile number
        document.getElementById('mobileNumber').addEventListener('input', function() {
            const input = this.value;
            const pattern = /^01[3-9]\d{8}$/; // Pattern for Bangladeshi mobile numbers

            const errorMessage = document.getElementById('phone-error-message');
            if (!pattern.test(input)) {
                errorMessage.style.display = 'block';
            } else {
                errorMessage.style.display = 'none';
            }
        });
    });

    //update session

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
</main>
