<?php
session_start();
include("include/connect.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['pass'];

    $error = array();
    
    // Check if the email and password fields are empty
    if (empty($email)) {
        $error['login'] = "Enter Email";
    } else if (empty($password)) {
        $error['login'] = "Enter Password";
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
                $_SESSION['student'] = $e;
                $_SESSION['dept'] = $row['department'];
                $_SESSION['flash_message'] = "Logged in successfully"; // Flash message
    
                header("Location: student/index.php");
                exit(); // Use exit after header redirection
            }
        } else {
            $error[] = "Invalid email or password"; // If no rows returned
        }
    }
    
    // If there are any errors, store them in the session
    if (count($error) > 0) {
        $_SESSION['flash_message'] = implode(', ', $error); // Combine error messages
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Login Page</title>
    <link href="include/jkkniu.png" rel="icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="background-image:url(images/student.jpeg); background-repeat:no-repeat;">
<?php include("include/header.php"); ?>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 my-5 jumbotron">
                <h5 class="text-center my-3">Login to your account</h5>
                <?php
                if (isset($_SESSION['flash_message'])) {
                    echo "
                    <div id='flash-message' class='alert alert-danger alert-dismissible fade show' role='alert'>
                        " . $_SESSION['flash_message'] . "
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                    unset($_SESSION['flash_message']); // Unset the message after displaying it
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
                            <br>
                            <input type="submit" name="login" class="btn btn-success btn-block" value="Sign in">
                            <p>Don't have an account? <a href="student/register.php">Register Here</a></p>
                            <p><a href="student/forgot_password.php" class="text-danger">Forgot Password</a></p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
<script>
    // Fade out flash message after 5 seconds
    setTimeout(function() {
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            flashMessage.style.transition = "opacity 1s ease";
            flashMessage.style.opacity = "0";
            setTimeout(() => flashMessage.remove(), 1000); // Remove the element after fading out
        }
    }, 5000);

    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        // Toggle the type attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        // Toggle the eye icon
        eyeIcon.classList.toggle('fa-eye');
        eyeIcon.classList.toggle('fa-eye-slash');
    });
</script>
</body>
</html>
