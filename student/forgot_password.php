<!-- forgot_password.php -->
<?php
include("../include/connect.php");
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['send_otp'])) {
    $email = $_POST['email'];

    $errorMessages = '';

    // Validate email
    if (empty($email)) {
        $errorMessages .= "Email: Enter Email\n";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessages .= "Email: Invalid Email Format\n";
    }

    if (!empty($errorMessages)) {
        echo "<script>alert('$errorMessages');</script>";
    } else {
        // Check if the email exists in the database
        $sql = "SELECT * FROM students WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // If email exists, generate OTP and send it via email
            $otp = generateOTP();

            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'tls://smtp.gmail.com:587';  // Your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'mthospital2023@gmail.com';  // Your email address
            $mail->Password = 'ajkz yqcu wcup nlle';  // Your email password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('mthospital2023@gmail.com', 'Password Reset');
            $mail->addAddress($email);
            $mail->isHTML(true);

            $mail->Subject = 'Password Reset OTP';
            $mail->Body    = "Your password reset OTP is: $otp";

            if ($mail->send()) {
                // Save the OTP in the database
                $update_sql = "UPDATE students SET otp = '$otp' WHERE email = '$email'";
                mysqli_query($conn, $update_sql);

                echo "<script>alert('An email with the OTP has been sent. Please check your email.')</script>";
                header("location:reset_password.php");
            } else {
                echo "<script>alert('Error sending email: " . $mail->ErrorInfo . "');</script>";
            }
        } else {
            echo "<script>alert('Email not found.');</script>";
        }
    }
}

function generateOTP()
{
    return rand(100000, 999999);
}
?>
<!-- Your HTML Form for email input and submit button -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Add your stylesheets or use Bootstrap if needed -->
    <link rel="stylesheet" href="path/to/your/styles.css">
</head>
<body>

<!-- Your Header Goes Here -->
<?php include("header.php"); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title text-center">Forgot Password</h5>
                    <form method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Enter your email">
                        </div>

                        <!-- Add more form fields if needed -->

                        <div class="form-group">
                            <button type="submit" name="send_otp" class="btn btn-primary btn-block">Send OTP</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Your Footer Goes Here -->
<?php include("../footer.php"); ?>

<!-- Add your scripts or use Bootstrap scripts if needed -->
<script src="path/to/your/scripts.js"></script>
</body>
</html>
