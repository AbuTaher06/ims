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

$pageTitle = "Student | Profile";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");
$dept = $_SESSION['dept'];
// Fetch courses for the specific department
$sql = "SELECT *
        FROM `courses` WHERE dept_name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $dept); // Assuming department_id is an integer
$stmt->execute();
$result = $stmt->get_result();
?>

<main id="main" class="main">
<div class="container mt-5">
    <h2 class="text-center">Courses for <?php echo $dept; ?> Department </h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Serial No</th>
                <th>Department Name</th>
                <th>Course Title</th>
                <th>Course Code</th>
                
                <th>Course Credit</th>
              
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $counter = 0;
                while ($row = $result->fetch_assoc()) {
                    $counter++;
                    echo "<tr>
                            <td>{$counter}</td>
                            <td>{$row['dept_name']}</td>
                            <td>{$row['course_title']}</td>
                            <td>{$row['course_code']}</td>
                            <td>{$row['course_credit']}</td>
                         
                           
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No courses found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</main>

<?php include("footer.php"); ?>

