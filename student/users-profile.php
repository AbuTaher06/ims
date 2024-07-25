<?php
session_start();
ob_start();
if (!isset($_SESSION['student'])) {
    header("Location: ../studentlogin.php");
    ob_end_flush();
    exit(); 
}
?>
<?php
$pageTitle = "Profile";
include("header.php"); // Include header file
include("sidebar.php"); // Include sidebar file
include("../include/connect.php");

$email = $_SESSION['student'];
$stmt = $conn->prepare("SELECT * FROM students WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Update Password
if (isset($_POST['update_pass'])) {
    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $con_pass = $_POST['con_pass'];

    // Fetch current password hash from database
    $current_password_hashed = $row['password'];

    // Validate form inputs and passwords
    if (empty($old_pass) || empty($new_pass) || empty($con_pass)) {
        $error = "All fields are required";
    } elseif ($old_pass != $current_password_hashed) {
        $error = "Invalid old password";
    } elseif ($new_pass !== $con_pass) {
        $error = "New password and confirm password do not match";
    } else {
        $update_stmt = $conn->prepare("UPDATE students SET password = ? WHERE email = ?");
        $update_stmt->bind_param("ss", $con_pass, $email);

        if ($update_stmt->execute()) {
            echo "<script>alert('Password Updated Successfully');</script>";
        } else {
            $error = "Failed to update password: " . $conn->error;
        }
    }

    // Debugging error message
    if (isset($error)) {
        echo "<script>alert('Error: $error');</script>";
    }
}

// Update Profile
if (isset($_POST['update_profile'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $new_email = $_POST['email'];
    $profile_picture = $row['profile']; // Keep the current profile picture

    // Handle profile picture upload
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $target_dir = "../admin/uploads/"; // Updated path
        $imageFileType = strtolower(pathinfo($_FILES["profile_pic"]["name"], PATHINFO_EXTENSION));
        
        // Create a new filename based on the user's name
        $new_filename = strtolower(str_replace(' ', '_', $name)) . '.' . $imageFileType; // Replace spaces with underscores

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
        if ($check === false) {
            $error = "File is not an image.";
        }

        // Check file size (e.g., limit to 2MB)
        if ($_FILES["profile_pic"]["size"] > 2000000) {
            $error = "Sorry, your file is too large.";
        }

        // Allow certain file formats
        if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            $error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }

        // If no errors, try to upload the file
        if (!isset($error)) {
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_dir . $new_filename)) {
                $profile_picture = $new_filename; // Update profile picture name
            } else {
                $error = "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        // If no new file is uploaded, use default if current is not set
        if (empty($profile_picture)) {
            $profile_picture = 'default.jpeg'; // Use default image if none exists
        }
    }

    // Update the profile in the database
    $update_stmt = $conn->prepare("UPDATE students SET name = ?, phone = ?, email = ?, profile = ? WHERE email = ?");
    $update_stmt->bind_param("sssss", $name, $phone, $new_email, $profile_picture, $email);

    if ($update_stmt->execute()) {
        echo "<script>alert('Profile Updated Successfully');</script>";
        header("Location: " . $_SERVER['PHP_SELF']); // Redirect to the same page to prevent resubmission
        exit();
    } else {
        $error = "Failed to update profile: " . $conn->error;
    }

    // Debugging error message
    if (isset($error)) {
        echo "<script>alert('Error: $error');</script>";
    }
}

// Fetch students data for display
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>My Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">students</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card profile-card">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="profile-pic">
                            <img src="../admin/uploads/<?php echo !empty($row['profile']) ? $row['profile'] : 'default.jpeg'; ?>" alt="Profile" class="rounded-circle">
                        </div>
                        <h2 class="profile-name"><?php echo $row['name']; ?></h2>
                        <p class="profile-email"><?php echo $row['email']; ?></p>
                        <p class="profile-phone"><?php echo $row['phone']; ?></p>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card profile-details">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>
                        </ul>
                        <div class="tab-content pt-2">
                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                                <form method="post" enctype="multipart/form-data">
                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-lg-3 col-form-label">Name</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="name" type="text" class="form-control" id="name" value="<?php echo $row['name']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="phone" type="text" class="form-control" id="Phone" value="<?php echo $row['phone']; ?>" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="email" type="email" class="form-control" id="Email" value="<?php echo $row['email']; ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="profile_pic" class="col-md-4 col-lg-3 col-form-label">Profile Picture</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="profile_pic" type="file" class="form-control" id="profile_pic" accept="image/*">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="update_profile" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <form method="post">
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="old_pass" type="password" class="form-control" id="currentPassword" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="new_pass" type="password" class="form-control" id="newPassword" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="con_pass" type="password" class="form-control" id="renewPassword" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="update_pass" class="btn btn-primary">Change Password</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php
include("footer.php"); // Include footer file
?>
