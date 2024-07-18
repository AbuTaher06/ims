
<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['id'])) {
    // Unset session variables

    // Destroy the session
    session_destroy();

    // Redirect to the login page
    header("Location: ../adminlogin.php");
    exit;
} else {
    // Redirect to the login page if the user is not logged in
    header("Location: ../adminlogin.php");
    exit;
}
?>
