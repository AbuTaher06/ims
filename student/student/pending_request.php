<!DOCTYPE html>
<html>
<head>
    <title>Student dashboard</title>
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
session_start();
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
                <h4 class="text-danger text-center my-2">
                    Your Pending Request
                    <i class="fas fa-exclamation-circle"></i> <!-- Pending icon -->
                </h4>

                <div class="card">
                    <div class="card-body">
                        <?php
                        // Assuming $conn is your database connection

                        // Fetch data from the 'improvement_requested' table
                        $student = $_SESSION['students'];
                        $sql = "SELECT course_title, course_code, credit_hour, status FROM improvement_requested WHERE username='$student'";
                        $res = mysqli_query($conn, $sql);

                        $output = "
                        <table class='table table-bordered'>
                            <thead class='awesome-header'> <!-- Apply awesome header color here -->
                                <tr>
                                    <th>Course Title</th>
                                    <th>Course Code</th>
                                    <th>Credit Hour</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";

                        if (mysqli_num_rows($res) == 0) { // Check if there are no rows
                            $output .= "
    <tr>
        <td colspan='4' class='text-center'>You have no Request</td>
    </tr>
    ";
} else {
    $row_count = 0;
    while ($row = mysqli_fetch_array($res)) {
        // Determine row class based on row count
        $row_class = ($row_count % 2 == 0) ? 'even-row' : 'odd-row';

        // Determine button class based on status
        $status = $row['status'];
        $buttonClass = '';
        $icon = '';

        if ($status === 'Pending') {
            $buttonClass = 'btn btn-danger';
            $icon = '<i class="fas fa-clock"></i>'; // Font Awesome clock icon for pending
        } elseif ($status === 'Approved') {
            $buttonClass = 'btn btn-success';
            $icon = '<i class="fas fa-check"></i>'; // Font Awesome check icon for approved
        } elseif ($status === 'Rejected') {
            $buttonClass = 'btn btn-warning';
            $icon = '<i class="fas fa-times"></i>'; // Font Awesome times icon for rejected
        }

        $output .= "
        <tr class='$row_class'>
            <td>" . $row['course_title'] . "</td>
            <td>" . $row['course_code'] . "</td>
            <td>" . $row['credit_hour'] . "</td>
            <td><button class='$buttonClass'>$status $icon</button></td>
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
