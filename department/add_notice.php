<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
if (!isset($_SESSION['dept'])) {
    header("Location: ../deptlogin.php");
    ob_end_flush();
    exit();
}

$pageTitle = "Add Notice";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");

// Fetch unique sessions
$query_sessions = "SELECT DISTINCT session FROM exam_requests ORDER BY session";
$result_sessions = mysqli_query($conn, $query_sessions);
$sessions = [];
while ($row = mysqli_fetch_assoc($result_sessions)) {
    $sessions[] = $row['session'];
}
mysqli_free_result($result_sessions);

// Fetch unique years
$query_years = "SELECT DISTINCT year FROM exam_requests ORDER BY year";
$result_years = mysqli_query($conn, $query_years);
$years = [];
while ($row = mysqli_fetch_assoc($result_years)) {
    $years[] = $row['year'];
}
mysqli_free_result($result_years);

// Fetch unique semesters
$query_semesters = "SELECT DISTINCT semester FROM exam_requests ORDER BY semester";
$result_semesters = mysqli_query($conn, $query_semesters);
$semesters = [];
while ($row = mysqli_fetch_assoc($result_semesters)) {
    $semesters[] = $row['semester'];
}
mysqli_free_result($result_semesters);

// Process form submission for adding notice
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $session = $_POST['session'];
    $year = $_POST['year'];
    $semester = $_POST['semester'];
    $fileName = $_POST['fileName'];

    // Handle file upload
    if (isset($_FILES['noticeFile']) && $_FILES['noticeFile']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['noticeFile']['tmp_name'];
        $fileName = $_FILES['noticeFile']['name'];
        $fileSize = $_FILES['noticeFile']['size'];
        $fileType = $_FILES['noticeFile']['type'];
        
        // Allowed file types (pdf, jpg, jpeg, png)
        $allowedFileTypes = ['application/pdf', 'image/jpeg', 'image/png'];
        
        if (!in_array($fileType, $allowedFileTypes)) {
            echo "Only PDF, JPG, and PNG files are allowed.";
        } else {
            // Set the target directory for uploads
            $uploadDir = "uploads/"; // Make sure this folder exists
            $filePath = $uploadDir . basename($fileName);
            
            // Move the uploaded file to the target directory
            if (move_uploaded_file($fileTmpPath, $filePath)) {
                // Insert the notice into the database
                $stmt = $conn->prepare("INSERT INTO notices (session, year, semester, file_name, file_path) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $session, $year, $semester, $fileName, $filePath);
                if ($stmt->execute()) {
                    echo "<script>alert('Notice added successfully.');</script>";
                    echo "<script>setTimeout(function() { window.location.href = 'index.php'; }, 2000);</script>"; // Redirect after 2 seconds
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "There was an error uploading the file.";
            }
        }
    } else {
        echo "No file uploaded or there was an upload error.";
    }
}

$conn->close();
?>

<main id="main" class="main">
    <div class="container">
        <h2>Add Notice</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="session" class="form-label">Session:</label>
                <select class="form-select" name="session" id="session" required>
                    <option value="">Select Session</option>
                    <?php foreach ($sessions as $session): ?>
                        <option value="<?php echo htmlspecialchars($session); ?>"><?php echo htmlspecialchars($session); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="year" class="form-label">Year:</label>
                <select class="form-select" name="year" id="year" required>
                    <option value="">Select Year</option>
                    <?php foreach ($years as $year): ?>
                        <option value="<?php echo htmlspecialchars($year); ?>"><?php echo htmlspecialchars($year); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="semester" class="form-label">Semester:</label>
                <select class="form-select" name="semester" id="semester" required>
                    <option value="">Select Semester</option>
                    <?php foreach ($semesters as $semester): ?>
                        <option value="<?php echo htmlspecialchars($semester); ?>"><?php echo htmlspecialchars($semester); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="fileName" class="form-label">File Name:</label>
                <input type="text" class="form-control" id="fileName" name="fileName" required>
            </div>

            <div class="mb-3">
                <label for="noticeFile" class="form-label">File Upload (PDF, JPG, PNG):</label>
                <input type="file" class="form-control" id="noticeFile" name="noticeFile" accept=".pdf, .jpg, .jpeg, .png" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Notice</button>
        </form>
    </div>
</main>

<?php include("footer.php"); ?>
