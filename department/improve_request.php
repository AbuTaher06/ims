<?php

session_start();
$dept=$_SESSION['dept'];
include("../include/connect.php");

$sql="SELECT * FROM improvement_requested WHERE status='Pending' AND department='$dept' ORDER BY data_reg ASC";
$res=mysqli_query($conn,$sql);

$output="";

$output = "
<table class='table table-bordered'>
    <tr> 
    <th>Name</th>
    <th>Username</th>
    <th>Student ID</th>
    <th>Session</th>
    <th>Course Title</th>
    <th>Course Code</th>
    <th>Credit Hour</th>
        <th class='text-center'>Action</th>
    </tr>
";

if (mysqli_num_rows($res) == 0) { // Check if there are no rows
    $output .= "
        <tr>
            <td colspan='7' class='text-center'>No Job Request</td>
        </tr>
    ";
} else {
    while ($row = mysqli_fetch_array($res)) {
        $output .= "
            <tr>
            
            <td>".$row['name']."</td>
            <td>".$row['username']."</td>
            <td>".$row['student_id']."</td>
            <td>".$row['session']."</td>
            <td>".$row['course_title']."</td>
            <td>".$row['course_code']."</td>
            <td>".$row['credit_hour']."</td>
                <td>
                    <div class='col-md-12'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <button id='".$row['id']."' class='btn btn-success approve'>Approve</button>
                            </div>
                            <div class='col-md-6'>
                                <button id='".$row['id']."' class='btn btn-danger reject'>Reject</button>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        ";
    }
}

$output .= "</table>";

echo $output; // This will send the generated HTML back to the AJAX request

?>