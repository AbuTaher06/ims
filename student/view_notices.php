<?php
// Start session if it's not started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();

// Check if the user is logged in
if (!isset($_SESSION['dept'])) {
    header("Location: ../deptlogin.php");
    ob_end_flush();
    exit(); 
}

$pageTitle = "View Notices";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php"); // Include your database connection
?>

<main id="main" class="main">
    <div class="container">
        <h2>All Notices</h2>

        <?php
        // Fetch all notices from the database
        $query = "SELECT id, session, year, semester, file_name, file_path FROM notices";
        $result = mysqli_query($conn, $query);

        // Check if there are any notices
        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-bordered'>";
            echo "<thead>";
            echo "<tr><th>#</th></th><th>Session</th><th>Year</th><th>Semester</th><th>File Name</th><th>File Path</th></tr>";
            echo "</thead>";
            echo "<tbody>";

            // Display all notices
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['session'] . "</td>";
                echo "<td>" . $row['year'] . "</td>";
                echo "<td>" . $row['semester'] . "</td>";
                echo "<td>" . $row['file_name'] . "</td>";
                echo "<td><a href='/uploads" . $row['file_path'] . "' target='_blank'><i class='fas fa-download'></i> Download</a></td>";
                
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<p>No notices available.</p>";
        }

        // Close the result set
        mysqli_free_result($result);

        // Close database connection
        $conn->close();
        ?>
    </div>
</main>

<?php
// Include footer
include("footer.php");
?>
