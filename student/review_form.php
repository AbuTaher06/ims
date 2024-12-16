<?php
session_start();
$pageTitle = "Review Request";
include("header.php");
include("sidebar.php");
include("../include/connect.php");

// Check if form data exists in the session
if (!isset($_SESSION['form_data'])) {
    header("Location: request_form.php"); // Redirect back to the form if no data exists
    exit();
}

// Retrieve form data from the session
$formData = $_SESSION['form_data'];

// Handle edit functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    header("Location: request_form.php"); // Redirect back to the form for editing
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $name = $formData['name'];
    $student_id = $formData['student_id'];
    $department = $formData['department'];
    $session = $formData['session'];
    $phone = $formData['phone'];
    $course_code = $formData['course_code'];
    $course_title = $formData['course_title'];
    $course_credit = $formData['course_credit'];
    $year = $formData['year'];
    $semester = $formData['semester'];
    $transcript = !empty($formData['transcript']) ? $formData['transcript'] : null;

    // Prepare the SQL statement without 'request_date'
    $stmt = $conn->prepare("INSERT INTO exam_requests 
                            (student_name, department, student_id, session, phone, course_code, course_title, course_credit, year, semester, transcript_path, status) 
                            VALUES 
                            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')");

    if ($stmt) {
        // Bind only 11 parameters since 'status' is hardcoded
        $stmt->bind_param("sssssssssss", $name, $department, $student_id, $session, $phone, $course_code, $course_title, $course_credit, $year, $semester, $transcript);
        
        if ($stmt->execute()) {
            unset($_SESSION['form_data']);
            $_SESSION['flash_message'] = "Request submitted successfully!";
            // header("Location: success_page.php");
            // exit();
        } else {
            $_SESSION['flash_message'] = "Error submitting request: " . $stmt->error;
        }
    } else {
        $_SESSION['flash_message'] = "Error preparing statement: " . $conn->error;
    }
}



?>

<style>
    .card {
        border-radius: 0.5rem; /* Rounded corners for card */
    }
    .form-control {
        border: none;
        background: #f8f9fa;
        font-weight: bold;
    }
    .form-control:disabled {
        color: #000;
    }
    .alert {
        margin-bottom: 15px;
    }
    #flash-message {
        transition: opacity 0.5s ease-in-out;
    }
</style>

<main id="main" class="main" style="background-color: #f8f9fa; padding: 50px 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card -->
                <div class="card shadow-lg">
                    <div class="card-header text-center bg-primary text-white">
                        <h2 class="mb-0">Review Your Course Retake Request</h2>
                    </div>
                    <div class="card-body bg-light">
                        <?php if (isset($_SESSION['flash_message'])): ?>
                            <div class="alert alert-info" id="flash-message">
                                <?php echo $_SESSION['flash_message']; unset($_SESSION['flash_message']); ?>
                            </div>
                        <?php endif; ?>

                        <form method="POST" action="">
                            <div class="form-group">
                                <label>Name:</label>
                                <input type="text" class="form-control" value="<?php echo $formData['name']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label>Student ID:</label>
                                <input type="text" class="form-control" value="<?php echo $formData['student_id']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label>Department:</label>
                                <input type="text" class="form-control" value="<?php echo $formData['department']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label>Session:</label>
                                <input type="text" class="form-control" value="<?php echo $formData['session']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label>Phone:</label>
                                <input type="text" class="form-control" value="<?php echo $formData['phone']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label>Course Title:</label>
                                <input type="text" class="form-control" value="<?php echo $formData['course_title']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label>Course Code:</label>
                                <input type="text" class="form-control" value="<?php echo $formData['course_code']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label>Course Credit:</label>
                                <input type="text" class="form-control" value="<?php echo $formData['course_credit']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label>Year:</label>
                                <input type="text" class="form-control" value="<?php echo $formData['year']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label>Semester:</label>
                                <input type="text" class="form-control" value="<?php echo $formData['semester']; ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label>Transcript:</label><br>
                                <?php if (!empty($formData['transcript'])): ?>
                                    <a href="<?php echo $formData['transcript']; ?>" target="_blank" class="btn btn-link">View Uploaded Transcript</a>
                                <?php else: ?>
                                    <p class="text-muted">No file uploaded.</p>
                                <?php endif; ?>
                            </div>

                            <div class="form-group text-center">
                                <button type="submit" name="edit" class="btn btn-secondary">Edit</button>
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // Flash message will disappear after 5 seconds
    setTimeout(function() {
        document.getElementById('flash-message').style.opacity = 0;
    }, 5000);
</script>
