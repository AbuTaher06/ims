<?php
include("../include/connect.php");
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['create'])){
    $firstname = $_POST['firstname'];
    $username = $_POST['uname'];
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

    // Validate firstname
    if(empty($firstname)){
        $error['firstname'] = "Enter Firstname";
    }

    // Validate username
    if(empty($username)){
        $error['username'] = "Enter Username";
    }

    // Validate department
    if(empty($dept)){
        $error['dept'] = "Select a Department";
    }

    // Validate student ID
    if(empty($stud_id)){
        $error['stud_id'] = "Enter Student ID";
    }

    // Validate registration number
    if(empty($reg_no)){
        $error['reg_no'] = "Enter Registration Number";
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
        $minLength = 8;

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
        $error['pass'] = "Password does not meet the criteria.";
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
        $sql = "INSERT INTO students(name, username, department, stud_id, reg_no, email, gender, phone, password, data_reg, status, session, profile, otp) 
                VALUES('$firstname','$username','$dept','$stud_id','$reg_no','$email','$gender','$phone','$password', NOW(), 'pending', '$session', '$profile', '$otp')";

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
            background-color: #007bff; /* Bootstrap primary color */
            color: white;
            padding: 15px;
            text-align: center;
            font-size: 1.5rem;
            margin-bottom: 30px;
            border-radius: 5px;
        }
        .card {
            margin-top: 20px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .form-group {
            margin-bottom: 15px; /* Increased margin for better spacing */
        }
        .btn {
            margin-top: 15px; /* Added margin for button */
        }
        .text-danger {
            font-size: 0.9rem; /* Slightly smaller error message font */
        }
    </style>
</head>
<body>
<?php include("head1.php"); ?>
    <div class="container">
       
        <div class="row justify-content-center mt-2">
            <div class="col-md-8 col-lg-7">
                <div class="card bg-accent">
                    <div class="card-body bg-info">
                        <h5 class="card-title text-center">Create Account</h5>
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" name="firstname" class="form-control" autocomplete="off" placeholder="Enter Firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'];?>">
                                <?php if(isset($error['firstname'])) echo "<p class='text-danger'>".$error['firstname']."</p>"; ?>
                            </div>

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username" value="<?php if(isset($_POST['uname'])) echo $_POST['uname'];?>">
                                <?php if(isset($error['username'])) echo "<p class='text-danger'>".$error['username']."</p>"; ?>
                            </div>

                            <div class="form-group"> 
 
                            <select name="dept" id="department" class="form-control">
                            <option value="">Select Department</option>
                            <?php
                            $query = "SELECT * FROM department"; 
                            $result = mysqli_query($conn, $query);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?php echo $row['dept_name']; ?>"> <!-- Make sure 'Id' is capitalized correctly -->
                                        <?php echo $row['dept_name']; ?>
                                    </option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
               
                         </div>
                            <div class="form-group">
                                <label>Student ID</label>
                                <input type="text" name="stud_id" class="form-control" autocomplete="off" placeholder="Enter Student ID" value="<?php if(isset($_POST['stud_id'])) echo $_POST['stud_id'];?>">
                                <?php if(isset($error['stud_id'])) echo "<p class='text-danger'>".$error['stud_id']."</p>"; ?>
                            </div>

                            <div class="form-group">
                                <label>Reg No.</label>
                                <input type="text" name="reg_no" class="form-control" autocomplete="off" placeholder="Enter Your Reg. No ID" value="<?php if(isset($_POST['reg_no'])) echo $_POST['reg_no'];?>">
                                <?php if(isset($error['reg_no'])) echo "<p class='text-danger'>".$error['reg_no']."</p>"; ?>
                            </div>

                            <div class="form-group">
                        <label for="session">Current Session:</label>
                        <select class="form-control" id="session" name="session" required>
                            <option value="">Select Session</option>
                            <?php
                            for ($year = 2019; $year <= 2029; $year++) {
                                $next_year = $year + 1;
                                echo "<option value='{$year}-{$next_year}'>{$year}-{$next_year}</option>";
                            }
                            ?>
                        </select>
                        <?php if(isset($error['session'])) echo "<p class='text-danger'>".$error['session']."</p>"; ?>
                    </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" autocomplete="off" placeholder="Enter Your Email" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
                                <?php if(isset($error['email'])) echo "<p class='text-danger'>".$error['email']."</p>"; ?>
                            </div>

                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control" autocomplete="off" placeholder="Enter Your Phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone'];?>">
                                <?php if(isset($error['phone'])) echo "<p class='text-danger'>".$error['phone']."</p>"; ?>
                            </div>

                            <div class="form-group">
                                <label>Gender</label><br>
                                <input type="radio" name="gender" value="Male"> Male
                                <input type="radio" name="gender" value="Female"> Female
                                <?php if(isset($error['gender'])) echo "<p class='text-danger'>".$error['gender']."</p>"; ?>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter Password">
                                <?php if(isset($error['pass'])) echo "<p class='text-danger'>".$error['pass']."</p>"; ?>
                            </div>

                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Confirm your password">
                                <?php if(isset($error['con_pass'])) echo "<p class='text-danger'>".$error['con_pass']."</p>"; ?>
                            </div>

                            <div class="form-group">
                                <label>Profile Picture</label>
                                <input type="file" name="profile" class="form-control-file">
                                <?php if(isset($error['profile'])) echo "<p class='text-danger'>".$error['profile']."</p>"; ?>
                            </div>

                            <input type="submit" name="create" value="Register" class="btn btn-success btn-block">
                            <p class="text-center mt-3 ">Already have an Account? <a href="../studentLogin.php" class="text-danger">Click Here</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include("footer.php"); ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</body>
</html>







