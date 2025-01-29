<?php
session_start();
$pageTitle = "Course Improvement Application form";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");

$uname = $_SESSION['student'];
$sql = "SELECT * FROM students WHERE email='$uname'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$dept_name = $row['department'];
$student_name = $row['name'];
$roll = $row['stud_id'];
$phone = $row['phone'];
$session = $row['session'];

$dept_sql="SELECT * FROM department WHERE dept_name='$dept_name'";
$dept_result = mysqli_query($conn, $dept_sql);
$dept_row = mysqli_fetch_array($dept_result);
$dept = $dept_row['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $dept = $_POST['department'];
    $session = $_POST['session'];
    $phone = $_POST['phone'];
    
    $courseData = $_POST['courses'];
    $uploadErrors = [];
    $totalSubmittedCreditsByYear = [];

    // Calculate the total credits being submitted grouped by year
    foreach ($courseData as $course) {
        $year = $course['year'];
        $courseCredit = (float)$course['course_credit'];

        if (!isset($totalSubmittedCreditsByYear[$year])) {
            $totalSubmittedCreditsByYear[$year] = 0;
        }

        $totalSubmittedCreditsByYear[$year] += $courseCredit;
    }

    // Fetch total approved credits for the student, grouped by year
    $query = "SELECT year, SUM(course_credit) AS total_approved_credits 
              FROM exam_requests 
              WHERE student_id = '$student_id' 
                AND session = '$session' 
                AND sent_from_department = 'pending'
                AND department = '$dept'
              GROUP BY year";
    $result = mysqli_query($conn, $query);

    // Initialize an array to store the approved credits by year
    $totalApprovedCreditsByYear = [];
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $year = $row['year'];
            $totalApprovedCreditsByYear[$year] = (float)$row['total_approved_credits'];
        }
    } else {
        echo "<p>No data found or error in query execution.</p>";
        echo "Error: " . mysqli_error($conn);  // Display query error for debugging
    }

    // Validate the combined total credits for each year
    foreach ($totalSubmittedCreditsByYear as $year => $submittedCredits) {
        // Fetch the already approved credits for the year
        $approvedCredits = isset($totalApprovedCreditsByYear[$year]) ? $totalApprovedCreditsByYear[$year] : 0;
        $combinedCredits = $submittedCredits + $approvedCredits;

        // If the combined credits exceed 6, show an error message
        if ($combinedCredits > 6) {
            $_SESSION['flash_message'] = " For Year $year, you cannot submit more than " . (6 - $approvedCredits) . " credits. 
            You already have $approvedCredits approved credits.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    }

    // Proceed with inserting data into the database if validation passes
    foreach ($courseData as $index => $course) {
        $courseTitle = $course['course_title'];
        $courseCode = $course['course_code'];
        $courseCredit = $course['course_credit'];
        $courseYear = $course['year'];
        $semester = $_POST['courses'][$index]['semester'];

        // Handle file upload
        if (isset($_FILES['transcripts']['name'][$index]) && $_FILES['transcripts']['error'][$index] == 0) {
            $targetDir = "transcripts/";
            $fileName = basename($_FILES['transcripts']['name'][$index]);
            $targetFilePath = $targetDir . $fileName;
            $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

            $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];
            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES['transcripts']['tmp_name'][$index], $targetFilePath)) {
                    $transcriptPath = $targetFilePath;

                    // Insert the course data into the database
                    $query = "INSERT INTO exam_requests 
                              (student_name, department, student_id, session, phone, course_code, course_title, course_credit, year,semester, transcript_path, sent_from_department, request_date) 
                              VALUES 
                              ('$name', '$dept', '$student_id', '$session', '$phone', '$courseCode', '$courseTitle', '$courseCredit', '$courseYear','$semester', '$transcriptPath', 'pending', NOW())";
                        
                    if (!mysqli_query($conn, $query)) {
                        $uploadErrors[] = "Error saving course $courseCode: " . mysqli_error($conn);
                    }
                } else {
                    $uploadErrors[] = "Failed to upload file for course $courseCode.";
                }
            } else {
                $uploadErrors[] = "Invalid file type for course $courseCode.";
            }
        } else {
            $uploadErrors[] = "No valid transcript uploaded for course $courseCode.";
        }
    }

    if (empty($uploadErrors)) {
        echo "<script>alert('Your request has been submitted successfully.');</script>";
    } else {
        $_SESSION['flash_message'] = implode("<br>", $uploadErrors);
    }

    header("Location: index.php");
    exit();
}
?>



<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
.form-group label {
    font-weight: bold; /* Makes all labels bold */
}
</style>

<main id="main" class="main" style="background-color: #f8f9fa; padding: 50px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-primary text-white">
                        <h2 class="mb-0">Course Improvement Application form</h2>
                        <p>Please fill in the details carefully</p>
                    </div>
                    <div class="card-body bg-light">
                        <div class="alert alert-info">
                            <strong>Note:</strong> You can submit a maximum of 6 credits per year. 
                            If you have already submitted some credits, you can only submit the remaining credits.
                        </div>
                        <?php if (isset($_SESSION['flash_message'])) : ?>
                        <div id="flash-message" class="alert alert-info alert-dismissible fade show" role="alert">
                            <?php echo $_SESSION['flash_message']; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php endif; ?>
                    <?php unset($_SESSION['flash_message']); ?>


                    <form method="POST" action="" enctype="multipart/form-data" id="course-form">
    <!-- User Information -->
    <div class="form-group">
        <label for="name"><strong>Name:</strong></label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $student_name; ?>" required readonly>
    </div>
    <div class="form-group">
        <label for="department"><strong>Department:</strong></label>
        <input type="text" class="form-control" id="department" name="department" value="<?php echo $dept; ?>" required>
    </div>
    <div class="form-group">
        <label for="student_id"><strong>Student ID:</strong></label>
        <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo $roll; ?>" required readonly>
    </div>
    <div class="form-group">
        <label for="current_session"><strong>Current Session:</strong></label>
        <input type="text" class="form-control" id="current_session" name="current_session" value="<?php echo $session; ?>" required readonly>
    </div>
    <div class="form-group">
        <label for="session"><strong>Improvement Session:</strong></label>
        <select class="form-control" id="session" name="session" required>
            <option value="">Select Session within which you are participating Exam</option>
            <?php for ($year = 2019; $year <= 2029; $year++) {
                $next_year = $year + 1;
                echo "<option value='{$year}-{$next_year}'>{$year}-{$next_year}</option>";
            } ?>
        </select>
    </div>
    <!-- Course Container -->
    <div id="course-container">
        <div class="course-group" id="course-1" style="background-color: #e7f3fe; border-left: 5px solid #2196F3;">
            <h5><i class="fas fa-book"></i> Course 1</h5>
            <div class="form-group">
                <label for="course_title_1"><strong>Course Title:</strong></label>
                <input type="text" class="form-control" name="courses[0][course_title]" placeholder="Enter Course Title" required>
            </div>
            <div class="form-group">
                <label for="course_code_1"><strong>Course Code:</strong></label>
                <input type="text" class="form-control" name="courses[0][course_code]" placeholder="Enter Course Code" required>
            </div>
            <div class="form-group">
                <label for="course_credit_1"><strong>Course Credit:</strong></label>
                <input type="text" class="form-control" name="courses[0][course_credit]" placeholder="Enter Course Credit" required>
            </div>
            <div class="form-group">
                <label for="year_1"><strong>Year:</strong></label>
                <select class="form-control" name="courses[0][year]" required>
                    <option value="">Select Year</option>
                    <option value="1st Year">1st</option>
                    <option value="2nd Year">2nd</option>
                    <option value="3rd Year">3rd</option>
                    <option value="4th Year">4th</option>
                </select>
            </div>
            <div class="form-group">
                <label for="semester_1"><strong>Semester:</strong></label>
                <select class="form-control" name="courses[0][semester]" required>
                    <option value="">Select Semester</option>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>
                </select>
            </div>
            <div class="form-group">
                <label for="transcript_1"><strong>Add Transcript:</strong></label>
                <input type="file" class="form-control" name="transcripts[]" accept=".pdf, .jpg, .jpeg, .png" required>
            </div>
            <button type="button" class="btn btn-danger remove-course"><i class="fas fa-trash-alt"></i> Remove</button>
            <hr>
        </div>
    </div>
    <button type="button" class="btn btn-secondary" id="add-course"><i class="fas fa-plus-circle"></i> Add Another Course</button>
    <button type="submit" class="btn btn-primary btn-block mt-3" id="submit-btn"><i class="fas fa-paper-plane"></i> Submit Requests</button>
</form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
// Function to add new courses
document.getElementById('add-course').addEventListener('click', function () {
    const courseContainer = document.getElementById('course-container');
    const courseCount = courseContainer.getElementsByClassName('course-group').length;
    const newCourseIndex = courseCount;

    // Randomly assign a background color and border color
    const colors = [
        {bg: '#e7f3fe', border: '#2196F3'},
        {bg: '#fff3cd', border: '#ffc107'},
        {bg: '#d4edda', border: '#28a745'},
        {bg: '#f8d7da', border: '#dc3545'}
    ];
    const {bg, border} = colors[newCourseIndex % colors.length];

    const newCourseGroup = `
        <div class="course-group" id="course-${newCourseIndex + 1}" style="background-color: ${bg}; border-left: 5px solid ${border};">
            <h5><i class="fas fa-book"></i> Course ${newCourseIndex + 1}</h5>
            <div class="form-group">
                <label for="course_title_${newCourseIndex}">Course Title:</label>
                <input type="text" class="form-control" name="courses[${newCourseIndex}][course_title]" placeholder="Enter Course Title" required>
            </div>
            <div class="form-group">
                <label for="course_code_${newCourseIndex}">Course Code:</label>
                <input type="text" class="form-control" name="courses[${newCourseIndex}][course_code]" placeholder="Enter Course Code" required>
            </div>
            <div class="form-group">
                <label for="course_credit_${newCourseIndex}">Course Credit:</label>
                <input type="text" class="form-control" name="courses[${newCourseIndex}][course_credit]" placeholder="Enter Course Credit" required>
            </div>
            <div class="form-group">
                <label for="year_${newCourseIndex}">Year:</label>
                <select class="form-control" name="courses[${newCourseIndex}][year]" required>
                    <option value="">Select Year</option>
                    <option value="1st Year">1st</option>
                    <option value="2nd Year">2nd</option>
                    <option value="3rd Year">3rd</option>
                    <option value="4th Year">4th</option>
                </select>
            </div>
            <div class="form-group">
                <label for="semester_${newCourseIndex}">Semester:</label>
                <select class="form-control" name="courses[${newCourseIndex}][semester]" required>
                    <option value="">Select Semester</option>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>
                </select>
            </div>
            <div class="form-group">
                <label for="transcript_${newCourseIndex}">Add Transcript:</label>
                <input type="file" class="form-control" name="transcripts[]" accept=".pdf, .jpg, .jpeg, .png" required>
            </div>
            <button type="button" class="btn btn-danger remove-course"><i class="fas fa-trash-alt"></i> Remove</button>
            <hr>
        </div>`;
    courseContainer.insertAdjacentHTML('beforeend', newCourseGroup);
    attachRemoveEvent();
});

// Function to attach remove button functionality
function attachRemoveEvent() {
    const removeButtons = document.querySelectorAll('.remove-course');
    removeButtons.forEach((button) => {
        button.addEventListener('click', function () {
            this.closest('.course-group').remove(); // Remove the corresponding course group
        });
    });
}

// Ensure at least one course is added before submission
document.getElementById('course-form').addEventListener('submit', function (event) {
    const courseContainer = document.getElementById('course-container');
    const courses = courseContainer.getElementsByClassName('course-group');
    if (courses.length < 1) {
        alert("Please add at least one course before submitting.");
        event.preventDefault(); // Prevent form submission
    }
});
// Attach remove event on page load for the default course
attachRemoveEvent();

window.addEventListener('DOMContentLoaded', (event) => {
    setTimeout(function() {
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.classList.remove('show');
            flashMessage.classList.add('fade');
            setTimeout(() => flashMessage.remove(), 500); // Extra delay for complete removal
        }
    }, 5000);
});

</script>
