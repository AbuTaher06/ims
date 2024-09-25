<?php
session_start();
include("include/connect.php");

if (isset($_POST['login'])) {
    $email = $_POST['email']; // Change from username to email
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
        $sql = "SELECT * FROM students WHERE email='$email' AND password='$password' AND status='Approved'";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $e = $row['email']; // Get the email from the result
            
            // Store the email in the session
            $_SESSION['student'] = $e;
            $_SESSION['flash_message'] = "Logged in successfully"; // Flash message

            header("Location: student/index.php");
            exit(); // Use exit after header redirection
        } else {
            $_SESSION['flash_message'] = "Invalid Account or You are not verified"; // Flash message
        }
    } else {
        $_SESSION['flash_message'] = $error['login']; // Flash message
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Login page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
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
                                <label>Email</label> <!-- Changed label from Username to Email -->
                                <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="pass" class="form-control" placeholder="Enter Password">
                            </div>
                            <br>
                            <input type="submit" name="login" class="btn btn-success btn-block" value="Sign in">
                            <p>Don't have an account? <a href="./student/register.php">  Register Here</a></p>
                            <p><a href="./student/forgot_password.php" class="text-danger"> Forgot Password</a></p>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6"></div>
        </div>
    </div>
</div>
<?php include("footer.php"); ?>
</body>
</html>
