<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Registration Form</title>
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
    $stud_id = $_POST["stud_id"];
    $reg_no = $_POST["reg_no"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $session = $_POST["session"];
    $profile_picture = $_FILES["profile_picture"]["name"]; // Assuming file upload

    // Set the data_reg to the current date
    $data_reg = date("Y-m-d");

    // Set status to 'active'
    $status = 'active';
    // Prepare SQL statement
    $sql = "INSERT INTO students (name, username, stud_id, reg_no, email, gender, phone, password, session, profile, data_reg, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssssssssssss", $name, $username, $stud_id, $reg_no, $email, $gender, $phone, $password, $session, $profile_picture, $data_reg, $status);

    // Execute statement
    if ($stmt->execute()) {
        echo "New record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();
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
          <h3 class="card-header bg-primary text-white text-center">Add Student</h3>
          <div class="card-body">
            <form action="" method="POST" enctype="multipart/form-data">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
              </div>
              <div class="form-group">
                <label for="stud_id">Student ID</label>
                <input type="text" class="form-control" id="stud_id" name="stud_id" required>
              </div>
              <div class="form-group">
                <label for="reg_no">Registration Number</label>
                <input type="text" class="form-control" id="reg_no" name="reg_no" required>
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="gender">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                  <option value="other">Other</option>
                </select>
              </div>
              <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
              </div>
              <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <div class="form-group">
                <label for="session">Session</label>
                <input type="text" class="form-control" id="session" name="session" required>
              </div>
              <div class="form-group">
                <label for="profile_picture">Profile Picture</label>
                <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
              </div>
              <button type="submit" class="btn btn-primary btn-block">Submit</button>
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
