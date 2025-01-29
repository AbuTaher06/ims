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
    <div class="container my-5">
        <h2 class="text-center mb-4">All Notices</h2>

        <?php
        // Fetch all notices from the database
        $query = "SELECT id, session, year, semester, file_name, file_path FROM notices";
        $result = mysqli_query($conn, $query);

        // Check if there are any notices
        if (mysqli_num_rows($result) > 0) {
            echo "<table class='table table-hover table-bordered'>";
            echo "<thead class='thead-dark'>";
            echo "<tr><th>#</th><th>Session</th><th>Year</th><th>Semester</th><th>File Name</th><th>Action</th></tr>";
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
                echo "<td><a href='../department/" . $row['file_path'] . "' target='_blank' class='btn btn-primary btn-sm'><i class='fas fa-download'></i> Download</a></td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
        } else {
            echo "<div class='alert alert-warning text-center'>No notices available.</div>";
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

<!-- Add custom CSS for styling -->
<style>
    body {
        background-color: #f8f9fa; /* Light background color */
    }

    .main {
        padding: 20px;
        border-radius: 8px;
        background-color: #ffffff; /* White background for the main content */
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

    h2 {
        color: #007bff; /* Primary color for headings */
    }

    .table {
        border-radius: 8px; /* Rounded corners for the table */
        overflow: hidden; /* Prevent overflow */
    }

    .table th, .table td {
        vertical-align: middle; /* Center align text vertically */
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1; /* Light gray on hover */
    }

    .btn-primary {
        background-color: #007bff; /* Primary button color */
        border-color: #007bff; /* Primary button border color */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Darker shade on hover */
        border-color: #0056b3; /* Darker border on hover */
    }
</style>
