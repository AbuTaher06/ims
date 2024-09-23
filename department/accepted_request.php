<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
ob_start();
if (!isset($_SESSION['dept'])) {
  header("Location: ../deptlogin.php");
  ob_end_flush();
  exit(); 
}

$pageTitle = "Student";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");
$dept=$_SESSION['dept'];
?>
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

<main id="main" class="main">
<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
           
            <div class="col-md-10">
            <h4 class="text-center my-3 text-success">
    Request Accepted
    <i class="fas fa-check-circle"></i> <!-- Accepted icon -->
</h4>


                <div class="card">
                    <div class="card-body">
                        <?php
                        $sql = "SELECT * FROM improvement_requested where status='Approved' AND department='$dept'";
                        $res = mysqli_query($conn, $sql);

                        
              

                        $output = "
                        
                        <table class='table table-bordered'>
                            <thead class='awesome-header'> <!-- Apply awesome header color here -->
                                <tr>   
                                    <th class='text-center'>Name</th>
                                    <th>Student ID</th>
                                    <th>Session</th>
                                    <th>Course Title</th>
                                    <th>Course Code</th>
                                    <th>Credit Hour</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                        ";

                        if (mysqli_num_rows($res) == 0) { // Check if there are no rows
                            $output .= "
                            <tr>
                                <td colspan='7' class=' text-danger text-center'><h4>You have no Approved Entry!!</h4></td>
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
</main>
<?php
include("footer.php");
?>

