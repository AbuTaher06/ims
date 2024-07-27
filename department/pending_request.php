<php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pending Request</title>
    <!-- Include Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Include Bootstrap for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Define the awesome header color */
        .awesome-header {
            background-color: #4CAF50; /* Green color */
            color: white; /* White text */
        }

        /* Style even rows */
        .even-row {
            background-color: #f2f2f2; /* Light gray */
        }

        /* Style odd rows */
        .odd-row {
            background-color: #dddddd; /* Dark gray */
        }
    </style>
</head>
<body>
<?php
$dept=$_SESSION['dept'];
include("header.php");
include("../include/connect.php");
?>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php
                include("sidenav.php");
                ?>
            </div>
            <div class="col-md-10">
                <h4 class="text-center my-2 text-danger">
                    Pending Request for Improvement
                    <i class="fas fa-exclamation-circle"></i> <!-- Pending icon -->
                </h4>

                <div class="card">
                    <div class="card-body">
                        <?php
                        $sql = "SELECT * FROM improvement_requested where status='Pending' AND department='$dept'";
                        $res = mysqli_query($conn, $sql);

                        
                if (isset($_GET['student_id'])) {
                    $id = $_GET['student_id'];
                    $query1 = "SELECT * FROM students WHERE id='$id'";
                    $res1 = mysqli_query($conn, $query1);
                    $row1 = mysqli_fetch_array($res1);
                }
                

                        $output = "
                        
                        <table class='table table-bordered'>
                            <thead class='awesome-header'> <!-- Apply awesome header color here -->
                                <tr>   
                                    <th>Name</th>
                                    <th>Student ID</th>
                                    <th>Session</th>
                                    <th>Course Title</th>
                                    <th>Course Code</th>
                                    <th>Credit Hour</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";

                        if (mysqli_num_rows($res) == 0) { // Check if there are no rows
                            $output .= "
                            <tr>
                                <td colspan='7' class='text-center'>You have no Request</td>
                            </tr>
                            ";
                        } else {
                            $row_count = 0;
                            while ($row = mysqli_fetch_array($res)) {
                                // Debugging statement to check each row of data
                              

                                // Determine row class based on row count
                                $row_class = ($row_count % 2 == 0) ? 'even-row' : 'odd-row';
                                $output .= "
                                <tr class='$row_class'>
                                    <td>" . $row['name'] . "</td>
                                    <td>" . $row['student_id'] . "</td>
                                    <td>" . $row['session'] . "</td>
                                    <td>" . $row['course_title'] . "</td>
                                    <td>" . $row['course_code'] . "</td>
                                    <td>" . $row['credit_hour'] . "</td>
                                    <td><button class='btn btn-danger'>" . $row['status'] . "</button></td>
                                    <td>
                                
                                    <a href='view.php?id=" . $row['id'] . "&name=" . $row['username'] . "'>
                                        <button class='btn btn-info'>View Profile</button>
                                    </a>
                                </td>
                                </tr>
                                ";
                                $row_count++;
                            }
                        }

                        $output .= "</tbody></table>";

                        echo $output;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include("../footer.php");
?>
</body>
</html>