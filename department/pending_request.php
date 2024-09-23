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
</head>
<main id="main" class="main">

<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
          
            <div class="col-md-10">
                <h4 class="text-center my-2 text-danger">
                    Pending Request for Registration
                    <i class="fas fa-exclamation-circle"></i> <!-- Pending icon -->
                </h4>

                <div class="card">
                    <div class="card-body">
                        <?php
                        $sql = "SELECT * FROM imp_form where status='Pending' AND department='$dept'";
                        $res = mysqli_query($conn, $sql);
                     $row = mysqli_fetch_array($res);

                        
              

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
                              $row_count++;

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
</main>
<?php
include("footer.php");
?>
