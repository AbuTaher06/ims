<?php
session_start();
ob_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../admin_login.php");
    ob_end_flush();
    exit(); 
}

$pageTitle = 'Add Department';
include("header.php"); // Include header file
include("sidebar.php"); // Include sidebar file
include("../include/connect.php");
?>

<!-- Include FontAwesome for Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
  .form-group {
    margin-bottom: 1.5rem;
  }
  .form-group label {
    font-weight: 500;
    color: #333;
  }
  .form-control {
    border-radius: 5px;
    border: 1px solid #ddd;
    padding: 10px;
    font-size: 14px;
  }
  .form-control:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
  }
  .btn-success {
    background-color: #28a745;
    border: none;
    padding: 10px;
    font-size: 16px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
  }
  .btn-success:hover {
    background-color: #218838;
  }
  .card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  }
  .card-header {
    border-radius: 10px 10px 0 0;
    padding: 15px;
  }
  .card-body {
    padding: 20px;
  }
  .fa-icon {
    margin-right: 10px;
    color: #007bff;
  }
</style>

<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form values
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "INSERT INTO department (dept_name, username, password) VALUES ('$name', '$username', '$password')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<div class='alert alert-success text-center'>New record inserted successfully</div>";
    } else {
        echo "<div class='alert alert-danger text-center'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
?>

<main id="main" class="main">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-6 my-4">
        <div class="card p-4">
          <h3 class="card-header bg-primary text-white text-center">
            <i class="fas fa-building fa-icon"></i>Add Department
          </h3>
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name"><i class="fas fa-tag fa-icon"></i>Department Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="ALL LETTERS MUST BE CAPITAL" required>
              </div>
              <div class="form-group">
                <label for="username"><i class="fas fa-user fa-icon"></i>Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter a username" required>
              </div>
              <div class="form-group">
                <label for="password"><i class="fas fa-lock fa-icon"></i>Password</label>
                <div class="input-group">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" required>
                  <div class="input-group-append">
                    <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                      <i class="fas fa-eye" id="eyeIcon"></i>
                    </span>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-success mt-3" style="width: 150px; margin: 0 auto; display: block;">
                <i class="fas fa-plus-circle fa-icon"></i>Add
              </button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
</main>

<script>
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

<?php 
include('footer.php');
?>
