<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Students</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-card {
            max-width: 500px;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <?php
    $dept=$_SESSION['dept'];
    include("header.php");
    include("../include/connect.php")
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php include("sidenav.php"); ?>
            </div>

            <div class="col-md-10">
                <div class="container">
                    <?php
                    if (isset($_GET['id'])) {
                        $id = (int)$_GET['id'];
                        $query = "SELECT * FROM students WHERE id='$id' AND department='$dept'";
                        $res = mysqli_query($conn, $query);
                        $row = mysqli_fetch_array($res);
                    }
                    
                    ?>
                        <div>
                           <p style="text-align:center;color:#fff;background:purple;margin:0;padding:8px;width:100%"><?php echo "Name: " . $row['name'] . "<br>Student ID: " . $row['stud_id']. "<br>Session: " . $row['session']; ?></p> 
                        </div>
                    
                        <?php
                        $roll=$row['stud_id'];
                        ?>
                        <div class="card">



    <!-- <div class="card-body">
        <h5 class="card-title text-center" style="color:#fff;background:green;margin:0;padding:8px;">Improved Student Information</h5>

        <?php
        // Fetch data for improved student

        
        $improveQuery = "SELECT * FROM improve_students WHERE roll_no = '$roll'";
        $improveResult = mysqli_query($conn, $improveQuery);

        if ($improveResult && mysqli_num_rows($improveResult) > 0) {
            $improveData = mysqli_fetch_assoc($improveResult);
        ?>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th>Name</th>
                        <td><?php echo $improveData['name']; ?></td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td><?php echo $improveData['email']; ?></td>
                    </tr>
                    
                    <tr>
                        <th>Roll Number</th>
                        <td><?php echo $improveData['roll_no']; ?></td>
                    </tr>
                    <tr>
                        <th>Registration Number</th>
                        <td><?php echo $improveData['reg_no']; ?></td>
                    </tr>
                    <tr>
                        <th>Session</th>
                        <td><?php echo $improveData['session']; ?></td>
                    </tr>
                        <tr>
                            <th class="text-center" colspan="2">improvement Subject</th>
                        </tr> 
                       
                    <tr>
                        <th>Semester</th>
                        <td><?php echo $improveData['semester']; ?></td>
                    </tr>
                    <tr>
                        <th>Course Code</th>
                        <td><?php echo $improveData['course_code']; ?></td>
                    </tr>
                    <tr>
                        <th>Course Name</th>
                        <td><?php echo $improveData['course_name']; ?></td>
                    </tr>
                    
                </table>
            </div>
        <?php
         }else {
            echo "<p>No improvement data available for this student.</p>";
        }
        ?>
    </div> -->










    <div class="card">
        <div class="card-body">
        <h5 class="card-title text-center" style="color:#fff;background:orange;margin:0 px,50 px,0 px,50 px;padding:8px;">Total Credit Improvement Taken</h5>
        <!-- <h4>First Year </h4><p>6 Credit</p>
        <h4>Second Year </h4><p>6 Credit</p>
        <h4>Third Year </h4><p>6 Credit</p>
        <h4>Fourth Year </h4><p>6 Credit</p> -->
                <?php
                      $query = "
                      SELECT
                          CASE
                              WHEN semester LIKE '1%' THEN 'First Year'
                              WHEN semester LIKE '2%' THEN 'Second Year'
                              WHEN semester LIKE '3%' THEN 'Third Year'
                              WHEN semester LIKE '4%' THEN 'Fourth Year'
                          END AS year_title,
                          COALESCE(SUM(credit_hour), 0) AS total_credit_hour,
                          semester,
                          course_code,
                          course_name,
                          credit_hour
                      FROM improve_students
                      WHERE roll_no = '$roll'
                      GROUP BY year_title, semester, course_code, course_name, credit_hour
                      ORDER BY year_title, semester;
                  ";
                  
                  $result = mysqli_query($conn, $query);
                  
                  if ($result) {
                      $currentYearTitle = null;
                      $totalCreditYear = 0;
                  
                      while ($row = mysqli_fetch_assoc($result)) {
                          $year_title = $row['year_title'];
                          $total_credit_hour = $row['total_credit_hour'];
                          $semester = $row['semester'];
                          $course_code = $row['course_code'];
                          $course_name = $row['course_name'];
                          $credit_hour = $row['credit_hour'];
                  
                          // Output the HTML dynamically
                          if ($year_title !== $currentYearTitle) {
                              if ($currentYearTitle !== null) {
                                  // Display total credit for the previous year
                                  echo "<p>Total Credit Hour for $currentYearTitle: $totalCreditYear</p>";
                              }
                  
                              echo "<h4>$year_title</h4>";
                              $currentYearTitle = $year_title;
                              $totalCreditYear = 0; // Reset total credit for the new year
                          }
                  
                          echo "<p>Semester: $semester ,Course Code: $course_code, Course Name: $course_name, Credit Hour: $credit_hour</p>";
                          $totalCreditYear += floatval($credit_hour); // Convert to integer before adding
                          
                      }
                  
                      // Display total credit for the last year
                      echo "<p>Total Credit Hour for $currentYearTitle: $totalCreditYear</p>";
                  }
                 else {
                    // Handle the error
                    echo "Error executing query: " . mysqli_error($conn);
                    echo "<p>No Credit improvement data available for this student.</p>";
                } ?>

        </div>
    </div>
</div>

          
            </div>
        </div>
   <?php 
    include("../footer.php")
   ?>
</body>

</html>
