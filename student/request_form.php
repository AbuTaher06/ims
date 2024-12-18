<?php
session_start();
$pageTitle = "Request Form";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");

$uname = $_SESSION['student'];
$sql = "SELECT * FROM students WHERE email='$uname'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
$dept = $row['department'];
$name = $row['name'];
$roll = $row['stud_id'];
$phone = $row['phone'];
$dept=$row['department'];

// Fetch courses for the specific department
$courseQuery = "SELECT course_code, course_title, course_credit FROM courses WHERE dept_name = '$dept'";
$courseResult = mysqli_query($conn, $courseQuery);

// Insert request into database when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form input values
    $name = $_POST['name'];
    $student_id = $_POST['student_id'];
    $dept = $_POST['department'];
    $session = $_POST['session'];
    $phone = $_POST['phone'];
    $course_code = $_POST['course_code'];
    $course_title = $_POST['course_title'];
    $course_credit = $_POST['course_credit'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];

    // Handle file upload
    if (isset($_FILES['transcript']) && $_FILES['transcript']['error'] == 0) {
        $targetDir = "transcripts/";
        $fileName = basename($_FILES['transcript']['name']);
        $targetFilePath = $targetDir . $fileName;

        // Get file extension
        $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

        // Allowed file types
        $allowedTypes = ['pdf', 'jpg', 'jpeg', 'png'];

        // Validate file type
        if (in_array($fileType, $allowedTypes)) {
            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['transcript']['tmp_name'], $targetFilePath)) {
                $transcriptPath = $targetFilePath; // File successfully uploaded
            } else {
                $_SESSION['flash_message'] = "File upload failed.";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        } else {
            $_SESSION['flash_message'] = "Invalid file type. Only PDF, JPG, JPEG, and PNG files are allowed.";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    } else {
        $_SESSION['flash_message'] = "Please upload a valid transcript.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    // Insert request data into exam_requests table
    $query = "INSERT INTO exam_requests 
              (student_name, department, student_id, session, phone, course_code, course_title, course_credit, year, semester, transcript_path, status, request_date) 
              VALUES 
              ('$name', '$dept', '$student_id', '$session', '$phone', '$course_code', '$course_title', '$course_credit', '$year', '$semester', '$transcriptPath', 'pending', NOW())";

    if (mysqli_query($conn, $query)) {
        // Set flash message for success
        $_SESSION['flash_message'] = "Your request has been submitted successfully!";
    } else {
        $_SESSION['flash_message'] = "Error: " . mysqli_error($conn);
    }

    // Redirect to the same page to avoid form resubmission
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}



// Display flash message if set
$flash_message = isset($_SESSION['flash_message']) ? $_SESSION['flash_message'] : '';
unset($_SESSION['flash_message']); // Clear flash message after displaying
?>
<style>
    label {
        font-weight: bold; /* Makes all labels bold */
    }
</style>
<main id="main" class="main" style="background-color: #f8f9fa; padding: 50px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card with shadow -->
                <div class="card shadow-lg">
                    <!-- Card Header with background and text -->
                    <div class="card-header text-center bg-primary text-white">
                        <h2 class="mb-0">Submit Course Retake Request</h2>
                        <p class="mt-1 small">Please fill in the details carefully</p>
                    </div>
                    <div class="card-body bg-light">
                        <!-- Display flash message if it exists -->
                        <?php if ($flash_message): ?>
                            <div class='alert alert-success' role='alert' id='flash-message'>
                                <?php echo $flash_message; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Form -->
                        <form method="POST" action="" enctype="multipart/form-data"> <!-- Added enctype for file upload -->
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="department">Department:</label>
                                <input type="text" class="form-control" id="department" name="department" value="<?php echo $dept; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="student_id">Student ID:</label>
                                <input type="text" class="form-control" id="student_id" name="student_id" value="<?php echo $roll; ?>" required readonly>
                            </div>

                            <div class="form-group">
                                <label for="session">Current Session:</label>
                                <select class="form-control" id="session" name="session" required>
                                    <option value="">Select Session</option>
                                    <?php
                                    for ($year = 2019; $year <= 2029; $year++) {
                                        $next_year = $year + 1;
                                        echo "<option value='{$year}-{$next_year}'>{$year}-{$next_year}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="phone">Phone Number:</label>
                                <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $phone; ?>" required>
                            </div>

                            <!-- Course Title Dropdown -->
                            <div class="form-group">
                                <label for="course_title">Course Title:</label>
                                <select class="form-control" id="course_title" name="course_title" required>
                                    <option value="">Select Course Title</option>
                                    <?php
                                    if (mysqli_num_rows($courseResult) > 0) {
                                        while ($row = mysqli_fetch_assoc($courseResult)) {
                                            echo "<option value='" . $row['course_title'] . "' data-course-code='" . $row['course_code'] . "' data-course-credit='" . $row['course_credit'] . "'>" . $row['course_title'] . "</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="course_code">Course Code:</label>
                                <input type="text" class="form-control" id="course_code" name="course_code" readonly required>
                            </div>

                            <div class="form-group">
                                <label for="course_credit">Course Credit:</label>
                                <input type="text" class="form-control" id="course_credit" name="course_credit" readonly required>
                            </div>

                            <div class="form-group">
                                <label for="year">Year:</label>
                                <select class="form-control" id="year" name="year" required>
                                    <option value="">Select Year</option>
                                    <option value="1st Year">1st</option>
                                    <option value="2nd Year">2nd</option>
                                    <option value="3rd Year">3rd</option>
                                    <option value="4th Year">4th</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="semester">Semester:</label>
                                <select class="form-control" id="semester" name="semester" required>
                                    <option value="">Select Semester</option>
                                    <option value="1st">1st</option>
                                    <option value="2nd">2nd</option>
                                </select>
                            </div>

                            <!-- Add Transcript File Input -->
                            <div class="form-group">
                                <label for="transcript">Add Transcript:</label>
                                <input type="file" class="form-control" id="transcript" name="transcript" accept=".pdf, .jpg, .jpeg, .png" required>
                                <small class="form-text text-muted">Please upload a PDF or image file (JPG, JPEG, PNG).</small>
                                <div id="preview-container" class="mt-3"></div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-block">Submit Request</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<!-- jQuery and AJAX script to fetch course details -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    // When course_title is changed, fetch course details
    $('#course_title').change(function() {
        var selectedOption = $(this).find('option:selected');
        var course_code = selectedOption.data('course-code');
        var course_credit = selectedOption.data('course-credit');

        $('#course_code').val(course_code); // Set course code
        $('#course_credit').val(course_credit); // Set course credit
    });

    // Hide flash message after 5 seconds
    setTimeout(function() {
        $('#flash-message').fadeOut('slow');
    }, 5000);
});

document.getElementById('transcript').addEventListener('change', function (event) {
        const previewContainer = document.getElementById('preview-container');
        previewContainer.innerHTML = ''; // Clear any existing preview

        const file = event.target.files[0];
        if (file) {
            const fileType = file.type;
            
            // Handle image previews
            if (fileType.startsWith('image/')) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.alt = 'Preview of uploaded image';
                img.style.maxWidth = '100%';
                img.style.height = 'auto';
                previewContainer.appendChild(img);
            } 
            // Handle PDF previews
            else if (fileType === 'application/pdf') {
                const pdf = document.createElement('embed');
                pdf.src = URL.createObjectURL(file);
                pdf.type = 'application/pdf';
                pdf.width = '100%';
                pdf.height = '400px';
                previewContainer.appendChild(pdf);
            } 
            // If file type is not supported
            else {
                const message = document.createElement('p');
                message.textContent = 'File preview not available for this format.';
                message.className = 'text-warning';
                previewContainer.appendChild(message);
            }
        }
    });
</script>
