<?php
include("../include/connect.php");

// Query to fetch data from the database
$sql = "SELECT * FROM imp_form";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Display Data</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-5">
    <h2 class="text-center mb-4">Data from Database</h2>
    <div class="row row-cols-1 row-cols-md-2 g-4">
      <?php
      if ($result->num_rows > 0) {
          // Output data of each row
          while ($row = $result->fetch_assoc()) {
              ?>
        <div class="col">
          <div class="card">
          <div class="card-body">
    <h5 class="card-title">Student Name: <?php echo $row["student_name_english"]; ?></h5>
    <h5 class="card-title">Student Name(Bangla): <?php echo $row["student_name_bangla"]; ?></h5>
    <p class="card-text">Department: <?php echo $row["department"]; ?></p>
    <p class="card-text">Father's Name: <?php echo $row["father_name"]; ?></p>
    <p class="card-text">Mother's Name: <?php echo $row["mother_name"]; ?></p>
    <p class="card-text">Current Semester: <?php echo $row["current_semester"]; ?></p>
    <p class="card-text">Readmission Semester: <?php echo $row["readmission_semester"]; ?></p>
    <p class="card-text">Exam Roll: <?php echo $row["exam_roll"]; ?></p>
    <p class="card-text">Mobile Number: <?php echo $row["mobile_number"]; ?></p>
    <p class="card-text">Course Details: <?php echo $row["course_details"]; ?></p>
    <p class="card-text">Declaration: <?php echo $row["declaration"]; ?></p>
    <p class="card-text">Date: <?php echo $row["date"]; ?></p>
    <p class="card-text">Signature: <?php echo $row["signature"]; ?></p>
</div>

          </div>
        </div>
        <?php
          }
      } else {
          echo "0 results";
      }
      $conn->close();
      ?>
    </div>
  </div>
</body>
</html>
