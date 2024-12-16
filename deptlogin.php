<?php
session_start();
include("include/connect.php");

if (isset($_POST["login"])) {
    $username = $_POST["uname"];
    $password = $_POST["pass"];
    $error = array();

    // Validation for empty fields
    if (empty($username)) {
        $error["dept"] = "Enter Username";
    } else if (empty($password)) {
        $error["dept"] = "Enter Password";
    }

    if (count($error) == 0) {
        $sql = "SELECT * FROM department WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION['dept'] = $username;
            $_SESSION['flash_message'] = "You have logged in successfully as a department!";
            $_SESSION['flash_message_type'] = "success"; // Store message type
            header('location:department/index.php');
            exit();
        } else {
            $_SESSION['flash_message'] = "Invalid Username or Password";
            $_SESSION['flash_message_type'] = "danger"; // Store message type
        }
    } else {
        $_SESSION['flash_message'] = $error["dept"];
        $_SESSION['flash_message_type'] = "danger"; // Store message type
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Department Login Page</title>
    <link href="include/jkkniu.png" rel="icon">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-image: url('background-image.jpg'); /* Replace 'background-image.jpg' with your actual image path */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        .jumbotron {
            margin-top: 30px;
            background-color: rgba(255, 255, 255, 0.8); /* Adjust the alpha value for transparency */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Add shadow effect */
        }
        #flash-message {
            opacity: 1;
            transition: opacity 1s ease-in-out;
        }
    </style>
</head>
<body>
    <?php include("include/header.php"); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="jumbotron shadow">
                    <div class="text-center">
                        <h3>Department Login</h3>
                    </div>

                    <!-- Display Flash Message -->
                    <?php if (isset($_SESSION['flash_message'])): ?>
                        <?php 
                            // Choose the alert type based on the message type stored in session
                            $alertType = $_SESSION['flash_message_type'] == 'success' ? 'alert-success' : 'alert-danger';
                        ?>
                        <div id="flash-message" class="alert <?= $alertType; ?> alert-dismissible fade show" role="alert">
                            <?= $_SESSION['flash_message']; ?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php unset($_SESSION['flash_message'], $_SESSION['flash_message_type']); ?>
                    <?php endif; ?>

                    <div class="card mx-auto mt-5" style="max-width: 400px;">
                        <div class="card-body">
                            <form method="post" class="my-2">
                                <div class="form-group">
                                    <label for="uname">Username</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-user"></i></span> <!-- User icon -->
                                        </div>
                                        <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username" value="<?php if (isset($_POST['uname'])) echo $_POST['uname']; ?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-lock"></i></span> <!-- Lock icon -->
                                        </div>
                                        <input type="password" id="password" name="pass" class="form-control" placeholder="Enter Password">
                                        <div class="input-group-append">
                                            <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                                <i class="fas fa-eye" id="eyeIcon"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" name="login" class="btn btn-success btn-block" value="Login">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php include("footer.php"); ?>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        // Fade out flash message after 5 seconds
        setTimeout(function() {
            const flashMessage = document.getElementById('flash-message');
            if (flashMessage) {
                flashMessage.style.opacity = "0"; // Fade out
                setTimeout(() => flashMessage.remove(), 1000); // Remove from DOM after fade out
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
            // Toggle the eye slash icon
            eyeIcon.classList.toggle('fa-eye');
            eyeIcon.classList.toggle('fa-eye-slash');
        });
    </script>
</body>
</html>
