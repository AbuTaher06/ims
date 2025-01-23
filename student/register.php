<?php
include("../include/connect.php");
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['create'])){
    $name = $_POST['name'];
    $dept = isset($_POST['dept']) ? $_POST['dept'] : "";  // Make sure department is set correctly
    $stud_id = $_POST['stud_id'];
    $reg_no = $_POST['reg_no'];
    $email = $_POST['email'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : "";
    $phone = $_POST['phone'];
    $password = isset($_POST['pass']) ? $_POST['pass'] : "";
    $confirm_password = isset($_POST['con_pass']) ? $_POST['con_pass'] : "";
    $session = isset($_POST['session']) ? $_POST['session'] : "";

    // Profile picture handling
    if(isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
        $profile = $_FILES['profile']['name'];
        $profile_temp = $_FILES['profile']['tmp_name'];
        move_uploaded_file($profile_temp, "img/$profile");
    } else {
        $profile = "default.jpg"; // Default profile picture if none uploaded
    }

    $error = array();

    // Validate Name
    if (empty($name)) {
        $error['name'] = "Enter Username";
    } elseif (!preg_match("/^[a-zA-Z\s.]+$/", $name)) {
        $error['name'] = "Name should contain only letters, spaces, and dots.";
    }
    
    

    // Validate department
    if(empty($dept)){
        $error['dept'] = "Select a Department";
    }

    // Validate student ID (exactly 9 digits)
        if (empty($stud_id)) {
            $error['stud_id'] = "Enter Student ID";
        } elseif (!preg_match("/^\d{0,9}$/", $stud_id)) {
            $error['stud_id'] = "Student ID must be digit and not more than 9 digits.";
        }

        // Validate registration number (exactly 5 digits)
        if (empty($reg_no)) {
            $error['reg_no'] = "Enter Registration Number";
        } elseif (!preg_match("/^\d{0,5}$/", $reg_no)) {
            $error['reg_no'] = "Registration Number must be digit and not more than 5 digits.";
        }


    // Validate email
    $sq = "SELECT * FROM students WHERE email = '$email'";
    $result = mysqli_query($conn, $sq);
    if(empty($email)){
        $error['email'] = "Enter Email";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error['email'] = "Invalid Email Format";
    } elseif (mysqli_num_rows($result) > 0) {
        // Email already exists, registration not valid
        $error['email'] = "Email already exists, registration not valid.";
    }

    // Validate gender
    if(empty($gender)){
        $error['gender'] = "Select Gender";
    }

    // Validate phone number
    if (empty($phone)) {
        $error['phone'] = "Enter Phone Number";
    } else {
        // Validate Bangladeshi phone number
        $pattern = '/^(?:\+88|88)?(01[3-9]\d{8})$/';
        if (!preg_match($pattern, $phone)) {
            $error['phone'] = "Invalid Bangladeshi Phone Number";
        }
    }

    // Validate password
    function validatePassword($password) {
        // Minimum length requirement
        $minLength = 4;
        // Check if the password meets the minimum length requirement
        if (strlen($password) < $minLength) {
            return false;
        }

        // Check for at least one lowercase letter
        if (!preg_match('/[a-z]/', $password)) {
            return false;
        }

        // Check for at least one uppercase letter
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }

        // Check for at least one digit
        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }

        // Check for at least one special character
        if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
            return false;
        }

        // All checks passed, the password is valid
        return true;
    }

    if (empty($password)) {
        $error['pass'] = "Enter Password";
    } elseif ($password != $confirm_password) {
        $error['pass'] = "Passwords do not match";
    } elseif (!validatePassword($password)) {
        $error['pass'] = "Password must be at least 6 characters long and include at least one lowercase letter, one uppercase letter, one digit, and one special character.";
    }

    // Validate session
    if(empty($session)){
        $error['session'] = "Enter Session";
    }

    // Validate profile picture
    if(isset($_FILES['profile']) && $_FILES['profile']['error'] == 0) {
        $profile_name = $_FILES['profile']['name'];
        $profile_size = $_FILES['profile']['size'];
        $profile_tmp = $_FILES['profile']['tmp_name'];
        $profile_type = $_FILES['profile']['type'];

        // Check file type
        $allowed_extensions = array("image/jpeg", "image/png", "image/gif");
        if(!in_array($profile_type, $allowed_extensions)) {
            $error['profile'] = "Invalid file format. Please upload an image file (JPEG, PNG, or GIF).";
        }

        // Check file size (max size: 2MB)
        $max_size = 2 * 1024 * 1024; // 2MB in bytes
        if($profile_size > $max_size) {
            $error['profile'] = "File size exceeds the maximum limit of 2MB.";
        }
    } else {
        // No file uploaded
        $error['profile'] = "Please upload a profile picture.";
    }

    // Generate OTP
    function generateOTP() {
        // Generate a random 6-digit OTP
        return rand(100000, 999999);
    }
    
    $otp = generateOTP();

    // If there are no errors, proceed with database insertion
    if(empty($error)){
        // Save the OTP directly in the students table
        $sql = "INSERT INTO students(name, department, stud_id, reg_no, email, gender, phone, password, data_reg, status, session, profile, otp) 
                VALUES('$name','$dept','$stud_id','$reg_no','$email','$gender','$phone','$password', NOW(), 'pending', '$session', '$profile', '$otp')";

        if (mysqli_query($conn, $sql)) {
            // Send the OTP via email using PHPMailer
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = 'tls://smtp.gmail.com:587';  // Your SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'mthospital2023@gmail.com';  // Your email address
            $mail->Password = 'ajkz yqcu wcup nlle';  // Your email password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('mthospital2023@gmail.com', 'Student Registration');
            $mail->addAddress($email, $username);
            $mail->isHTML(true);

            $mail->Subject = 'Verification Code for Registration';
            $mail->Body    = "Thanks for Registering. Your verification code is: $otp";

            if ($mail->send()) {
                echo "<script>alert('An email with the OTP has been sent. Please check your email.')</script>";
                // Redirect to OTP verification page
                header("Location: otp_verification.php");
                exit();  // Ensure the script ends after redirection
            } else {
                echo 'Error sending email: ' . $mail->ErrorInfo;
            }
        } else {
            echo "Error inserting record: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="../asset/images/jkkniu.png" rel="icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-image: url(images/studenth.jpeg);
            background-repeat: no-repeat;
            background-size: cover;
        }
        .header-caption {
            background-color: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 1.8rem;
            margin-bottom: 30px;
            border-radius: 5px;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        label {
            font-weight: bold;
        }
        .btn {
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <?php include("head1.php"); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card mt-5 p-4">
                    <div class="header-caption">
                        Create Account
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Enter Username" value="<?php if(isset($_POST['name'])) echo $_POST['name']; ?>">
                            <?php if(isset($error['name'])) echo "<small class='text-danger'>".$error['name']."</small>"; ?>
                        </div>

                        <div class="form-group">
                            <label for="department">Department</label>
                            <select name="dept" id="department" class="form-control">
                                <option value="">Select Department</option>
                                <?php
                                $query = "SELECT * FROM department";
                                $result = mysqli_query($conn, $query);
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<option value='{$row['dept_name']}'>{$row['dept_name']}</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="stud_id">Student ID</label>
                            <input type="text" name="stud_id" id="stud_id" class="form-control" placeholder="Enter Student ID" value="<?php if(isset($_POST['stud_id'])) echo $_POST['stud_id']; ?>">
                            <?php if(isset($error['stud_id'])) echo "<small class='text-danger'>".$error['stud_id']."</small>"; ?>
                        </div>

                        <div class="form-group">
                            <label for="reg_no">Reg No.</label>
                            <input type="text" name="reg_no" id="reg_no" class="form-control" placeholder="Enter Registration Number" value="<?php if(isset($_POST['reg_no'])) echo $_POST['reg_no']; ?>">
                            <?php if(isset($error['reg_no'])) echo "<small class='text-danger'>".$error['reg_no']."</small>"; ?>
                        </div>

                        <div class="form-group">
                            <label for="session">Current Session</label>
                            <select name="session" id="session" class="form-control">
                                <option value="">Select Session</option>
                                <?php for ($year = 2019; $year <= 2029; $year++): ?>
                                    <?php $next_year = $year + 1; ?>
                                    <option value="<?php echo "{$year}-{$next_year}"; ?>"><?php echo "{$year}-{$next_year}"; ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">
                            <?php if(isset($error['email'])) echo "<small class='text-danger'>".$error['email']."</small>"; ?>
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Your Phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone']; ?>">
                            <?php if(isset($error['phone'])) echo "<small class='text-danger'>".$error['phone']."</small>"; ?>
                        </div>

                        <div class="form-group">
                            <label>Gender</label><br>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="gender" value="Male" class="form-check-input" id="genderMale">
                                <label class="form-check-label" for="genderMale">Male</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="gender" value="Female" class="form-check-input" id="genderFemale">
                                <label class="form-check-label" for="genderFemale">Female</label>
                            </div>
                            <?php if(isset($error['gender'])) echo "<small class='text-danger'>".$error['gender']."</small>"; ?>
                        </div>

                        <div class="form-group">
    <label for="pass">Password</label>
    <div class="input-group">
        <input type="password" name="pass" id="pass" class="form-control" placeholder="Enter Password">
        <div class="input-group-append">
            <span class="input-group-text" id="togglePass" style="cursor: pointer;">
                <i class="fas fa-eye"></i>
            </span>
        </div>
    </div>
    <?php if(isset($error['pass'])) echo "<small class='text-danger'>".$error['pass']."</small>"; ?>
</div>

<div class="form-group">
    <label for="con_pass">Confirm Password</label>
    <div class="input-group">
        <input type="password" name="con_pass" id="con_pass" class="form-control" placeholder="Confirm Password">
        <div class="input-group-append">
            <span class="input-group-text" id="toggleConPass" style="cursor: pointer;">
                <i class="fas fa-eye"></i>
            </span>
        </div>
    </div>
    <?php if(isset($error['con_pass'])) echo "<small class='text-danger'>".$error['con_pass']."</small>"; ?>
</div>

                        <div class="form-group">
                            <label for="profile">Profile Picture</label>
                            <input type="file" name="profile" id="profile" class="form-control-file">
                            <?php if(isset($error['profile'])) echo "<small class='text-danger'>".$error['profile']."</small>"; ?>
                        </div>

                        <button type="submit" name="create" class="btn btn-success btn-block">Register</button>
                        <p class="text-center mt-3">Already have an account? <a href="../studentLogin.php" class="text-danger">Click Here</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- FontAwesome for Eye Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script>
    document.getElementById('togglePass').addEventListener('click', function () {
        let passField = document.getElementById('pass');
        let icon = this.querySelector('i');
        if (passField.type === 'password') {
            passField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });

    document.getElementById('toggleConPass').addEventListener('click', function () {
        let conPassField = document.getElementById('con_pass');
        let icon = this.querySelector('i');
        if (conPassField.type === 'password') {
            conPassField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            conPassField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>

<?php include("footer.php"); ?>
</body>
</html>








