<?php
session_start();
include("include/connect.php");

// Generate a simple CAPTCHA
function generateCaptcha() {
    $captcha_text = '';
    for ($i = 0; $i < 6; $i++) {
        $captcha_text .= chr(rand(65, 90)); // Generate random uppercase letters
    }
    $_SESSION['captcha'] = $captcha_text; // Store the CAPTCHA in session
    return $captcha_text;
}

// Check if the form is submitted
if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['pass'];
    $captcha = $_POST['captcha']; // Get CAPTCHA input

    $error = array();

    // Check if the email and password fields are empty
    if (empty($email)) {
        $error['login'] = "Enter Email";
    } else if (empty($password)) {
        $error['login'] = "Enter Password";
    } else if (empty($captcha)) {
        $error['login'] = "Enter CAPTCHA"; // Check if CAPTCHA is filled
    } else if ($captcha !== $_SESSION['captcha']) {
        $error['login'] = "Invalid CAPTCHA"; // Check CAPTCHA validity
    }

    if (count($error) == 0) {
        // Check if the account is active
        $sql = "SELECT * FROM students WHERE email='$email' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $e = $row['email'];
            $status = $row['status'];
            $otp_status = $row['otp_status'];

            if ($otp_status == 0) {
                $error[] = "Please verify your email first";
            } else if ($otp_status == 1 && $status == 'pending') {
                $error[] = "Wait for admin approval";
            } else if ($status == 'Approved' && $otp_status == 1) {
                // Set session variables
                $_SESSION['student'] = $e;
                $_SESSION['dept'] = $row['department'];

                // Set success message
                $success_message = "Logged in successfully"; // Success message

                // Redirect to the student dashboard after success message
                header("Location: student/index.php");
                exit();
            }
        } else {
            $error[] = "Invalid email or password"; // If no rows returned
        }
    }

    // If there are any errors, store them in the session
    if (count($error) > 0) {
        $error_message = implode(', ', $error); // Combine error messages
    }
}

$captcha_text = generateCaptcha(); // Generate CAPTCHA text
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login Page</title>
    <link href="include/jkkniu.png" rel="icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .reload-icon {
            cursor: pointer;
            margin-left: 10px;
            color: #007bff;
        }
        .reload-icon:hover {
            color: #0056b3;
        }
        .captcha-text {
            display: none; /* Hide CAPTCHA text from direct view */
        }
    </style>
</head>
<body style="background-image:url(images/student.jpeg); background-repeat:no-repeat;">
<?php include("include/header.php"); ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 my-5 jumbotron">
            <h5 class="text-center my-3">Login to your account</h5>

            <!-- Inline Success or Error Message -->
            <?php
            if (isset($error_message)) {
                echo "<div class='alert alert-danger'>$error_message</div>";
            } elseif (isset($success_message)) {
                echo "<div class='alert alert-success'>$success_message</div>";
            }
            ?>

            <div class="card">
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label>Password</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" id="password" name="pass" class="form-control" placeholder="Enter Password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                        <i class="fas fa-eye" id="eyeIcon"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- CAPTCHA Section -->
                        <div class="form-group">
                            <label>CAPTCHA</label>
                            <div class="input-group">
                                <input type="text" name="captcha" class="form-control" placeholder="Enter CAPTCHA" required>
                                <div class="input-group-append">
                                    <span class="input-group-text captcha-text"><?php echo $captcha_text; ?></span>
                                    <span class="input-group-text reload-icon" id="reloadCaptcha" title="Reload CAPTCHA">
                                        <i class="fas fa-sync-alt"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <input type="checkbox" name="remember"> Remember me
                        <input type="submit" name="login" class="btn btn-success btn-block" value="Sign in">
                        
                        <p>Don't have an account? <a href="student/register.php">Register Here</a></p>
                        <p><a href="student/forgot_password.php" class="text-danger">Forgot Password</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>

<script>
    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        eyeIcon.classList.toggle('fa-eye');
        eyeIcon.classList.toggle('fa-eye-slash');
    });

    // Reload CAPTCHA
    document.getElementById('reloadCaptcha').addEventListener('click', function() {
        // Reload the page to refresh CAPTCHA
        location.reload();
    });
</script>

</body>
</html>
