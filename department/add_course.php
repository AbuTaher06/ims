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

$pageTitle = "Add Course";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseCode = $_POST['courseCode'];
    $courseTitle = $_POST['courseTitle'];
    $creditHour = $_POST['creditHour'];
    $deptName = $_SESSION['dept']; // Get the department name from session

    // Fetch the department ID based on the department name
    $stmt = $conn->prepare("SELECT Id FROM department WHERE dept_name = ?");
    $stmt->bind_param("s", $deptName);
    $stmt->execute();
    $stmt->bind_result($deptId);
    $stmt->fetch();
    $stmt->close();

    if ($deptId) {
        // Prepare and bind for inserting the course
        $stmt = $conn->prepare("INSERT INTO courses (course_code, course_title, credit_hour, department_id,dept_name) VALUES (?, ?, ?, ?,?)");
        $stmt->bind_param("ssiis", $courseCode, $courseTitle, $creditHour, $deptId, $deptName);

        if ($stmt->execute()) {
            echo "New course added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Department not found.";
    }
}

$conn->close();
?>
<main id="main" class="main">
<div class="container">
    <h2>Add Course</h2>
    <form action="" method="post">
        <div class="mb-3">
            <label for="courseCode" class="form-label">Course Code:</label>
            <input type="text" class="form-control" id="courseCode" name="courseCode" required>
        </div>
        <div class="mb-3">
            <label for="courseTitle" class="form-label">Course Title:</label>
            <input type="text" class="form-control" id="courseTitle" name="courseTitle" required>
        </div>
        <div class="mb-3">
            <label for="creditHour" class="form-label">Credit Hour:</label>
            <input type="number" step="0.1" class="form-control" id="creditHour" name="creditHour" required>
        </div>
        <input type="hidden" name="department" value="<?php echo htmlspecialchars($dept); ?>">
        <button type="submit" class="btn btn-primary">Add Course</button>
    </form>
</div>
</main>

<?php include("footer.php"); ?>