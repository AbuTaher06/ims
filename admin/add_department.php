<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Department</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .form-group-inputs .form-control {
      margin-bottom: 0.5rem; /* Adjust the margin as needed */
    }
  </style>
</head>
<body>
    <?php 
    include("../include/connect.php");
    include("header.php");
  
// Assuming your form submits data using POST method

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

   <div class="container-fluid">
    <div class="row">
      <div class="col-md-2 p-0">
        <?php include("sidenav.php"); ?>
      </div>
      <div class="col-md-2"></div>
      <div class="col-md-6 my-4">
        <div class="card p-4">
          <h3 class="card-header bg-primary text-white text-center">Add Department</h3>
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Department name</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>

              <button type="submit" class="btn btn-success btn-block">Submit</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-2"></div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
