<!-- reset_password.php -->
<?php
session_start();
include("../include/connect.php");
$student=$_SESSION['students'];

if (isset($_POST['reset_password'])) {
    $new_password = $_POST['new_password'];
    $con_password = $_POST['con_password'];
    if($new_password!=$con_password){
        echo "<scrip;>alert('two password doesn't matched')</script>";
    }

    function validatePassword($new_password)
    {
        // Minimum length requirement
        $minLength = 8;

        // Check if the password meets the minimum length requirement
        if (strlen($new_password) < $minLength) {
            return false;
        }

        // Check for at least one lowercase letter
        if (!preg_match('/[a-z]/', $new_password)) {
            return false;
        }

        // Check for at least one uppercase letter
        if (!preg_match('/[A-Z]/', $new_password)) {
            return false;
        }

        // Check for at least one digit
        if (!preg_match('/[0-9]/', $new_password)) {
            return false;
        }

        // Check for at least one special character
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $new_password)) {
            return false;
        }

        // All checks passed, the password is valid
        return true;
    }

    if (empty($_POST['pass'])) {
        $error['pass'] = "Enter Password";
        
    } else if($new_password!=$con_password){
        $error['pass']="two password doesn't matched";
    }
    elseif (!validatePassword($_POST['pass'])) {
        $error['pass'] = "Password does not meet the criteria.";
        $error['pass']="
        At least 8 length.
        At least one lowercase letter.
        At least one uppercase letter.
        At least one digit.
        At least one special character.";
        
                
    }

    $errorMessages = '';

    // Validate email, OTP, and new password (similar to your registration form validations)

    if (!empty($errorMessages)) {
        echo "<script>alert('$errorMessages');</script>";
    } else {
        // Check if the entered OTP is correct
        $sql = "SELECT * FROM students WHERE username='$student'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            // If OTP is correct, update the password
            $update_sql = "UPDATE students SET password = '$new_password' WHERE email = '$email'";
            mysqli_query($conn, $update_sql);

            echo "<script>alert('Password reset successfully. You can now login with your new password.')</script>";
            header("location:../studentlogin.php");
        } else {
            echo "<script>alert('Invalid OTP. Please try again.')</script>";
        }
    }
}
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
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
                    <h5 class="card-title text-center">Password Reset</h5>
                    <form method="post" action="">

                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" id="old_password" name="old_password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" id="new_password" name="new_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" id="con_password" name="con_password" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" name="reset_password" class="btn btn-primary btn-block">Reset Password</button>
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

    </div>
</body>
</html>
