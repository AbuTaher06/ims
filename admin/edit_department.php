<?php
session_start();
ob_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../admin_login.php");
    ob_end_flush();
    exit(); 
}

$pageTitle = 'Edit Department';
include("header.php"); // Include header file
include("sidebar.php"); // Include sidebar file
include("../include/connect.php");

// Check if the department name is provided
if (isset($_GET['dept_name'])) {
    $dept_name = $_GET['dept_name'];

    // Fetch current department details
    $sql = "SELECT * FROM department WHERE dept_name = '$dept_name'";
    $result = mysqli_query($conn, $sql);
    $department = mysqli_fetch_assoc($result);

    // Handle form submission for updating the department
    if (isset($_POST['update'])) {
        $new_dept_name = $_POST['dept_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $profile = $_FILES['img']['name'];

        // Update the department in the database
        if (!empty($profile)) {
            move_uploaded_file($_FILES['img']['tmp_name'], "uploads/$profile");
            $update_sql = "UPDATE department SET dept_name='$new_dept_name', username='$username', password='$password', profile='$profile' WHERE dept_name='$dept_name'";
        } else {
            $update_sql = "UPDATE department SET dept_name='$new_dept_name', username='$username', password='$password' WHERE dept_name='$dept_name'";
        }

        if (mysqli_query($conn, $update_sql)) {
            // Redirect after successful update
            header("Location: department.php"); // Redirect to the departments list
            exit();
        } else {
            $error_message = "Error updating department: " . mysqli_error($conn);
        }
    }
} else {
    header("Location: department.php"); // Redirect if no department specified
    exit();
}
?>
<main id="main" class="main">
    <div class="container mt-5">
        <h2>Edit Department</h2>

        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="dept_name">Department Name</label>
                <input type="text" name="dept_name" class="form-control" value="<?php echo htmlspecialchars($department['dept_name']); ?>" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($department['username']); ?>" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <div class="input-group">
                    <input type="password" name="password" id="password" class="form-control" value="<?php echo htmlspecialchars($department['password']); ?>" required>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                            <i class="fa fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="img">Profile Image</label>
                <input type="file" name="img" class="form-control">
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update Department</button>
            <a href="department.php" class="btn btn-danger">Cancel</a>
        </form>
    </div>
</main>
<script>
    document.getElementById('togglePassword').addEventListener('click', function () {
        const passwordField = document.getElementById('password');
        const icon = this.querySelector('i');
        // Toggle the password field type
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordField.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
</script>
