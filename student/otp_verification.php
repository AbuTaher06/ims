<?php
include("../include/connect.php");


// Start session
session_start();

if (isset($_POST['verify_otp'])) {
    $email = $_POST['email'];
    $entered_otp = $_POST['otp'];

    // Check if the entered OTP is correct
    $sql = "SELECT * FROM students WHERE email = '$email' AND otp = '$entered_otp' AND status = 'pending'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // OTP is correct, update user status to 'verified'
        $update_sql = "UPDATE students SET otp_status = '1' WHERE email = '$email'";
        mysqli_query($conn, $update_sql);
        echo "<script>alert('OTP verified Successfully .')</script>";
        // Set session variables for user email and status
        $_SESSION['user_email'] = $email;
        $_SESSION['user_status'] = 'verified';

        // Redirect to OTP verification success page
        header("Location:../studentlogin.php");
        exit();
    } else {
        // Incorrect OTP or user not found
        echo "<script>alert('Invalid OTP. Please try again.')</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <!-- Add your CSS stylesheets or include Bootstrap if needed -->
    <link rel="stylesheet" href="path/to/header.css">
    <link rel="stylesheet" href="path/to/otp_verification.css">
    <style>
        /* Additional styles specific to OTP verification page */
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
        }

        #header {
            /* Styles for the header, adjust as needed */
        }

        #content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .otp-container {
            text-align: center;
            max-width: 400px;
            width: 100%;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2); /* Box shadow for background */
        }

        .otp-container label {
            display: block;
            margin-bottom: 10px;
        }

        .otp-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .otp-container button {
            background-color: #4caf50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        #footer {
            /* Styles for the footer, adjust as needed */
        }
    </style>
</head>
<body>
    
<?php include("head1.php"); ?>
    <div id="content">
        <div class="otp-container bg-info">
            <h2>OTP Verification</h2>
            <form method="post" action="">
           
                <label for="email">Email:</label>
                <input type="text" id="email" name="email" required>
                <br>
                <label for="otp">OTP:</label>
                <input type="text" id="otp" name="otp" required>
                <br>
                <button type="submit" name="verify_otp" class="btn-block">Verify OTP</button>
            </form>
        </div>
    </div>

    <div id="footer">
        <?php include("../footer.php"); ?>
    </div>
</body>
</html>
