<?php
session_start();
ob_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../admin_login.php");
    ob_end_flush();
    exit(); 
}

$pageTitle='Add Department';
include("header.php"); // Include header file
include("sidebar.php"); // Include sidebar file
include("../include/connect.php");
?>
  <style>
    .form-group-inputs .form-control {
      margin-bottom: 0.5rem; /* Adjust the margin as needed */
    }
  </style>
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form values
    $name = $_POST["name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $sql = "INSERT INTO department (dept_name, username,password) VALUES ('$name','$username','$password')";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<main id="main" class="main">
   <div class="container-fluid">
    <div class="row">
      
      <div class="col-md-2"></div>
      <div class="col-md-6 my-4">
        <div class="card p-4">
          <h3 class="card-header bg-primary text-white text-center">Add Department</h3>
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Department name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="ALL LETTER MUST BE CAPITAL" required>
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" placeholder="Enter a username"  required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password" required>
              </div>

              <button type="submit" class="btn btn-success btn-block mt-3">Submit</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>
  </main>
  <?php 
  include('footer.php');
  ?>