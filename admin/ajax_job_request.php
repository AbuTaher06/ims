<?php
include("../include/connect.php");

$sql="SELECT * FROM doctors WHERE status='Pending' ORDER BY data_reg ASC";
$res=mysqli_query($conn,$sql);

$output="";

$output = "
<table class='table table-bordered'>
    <tr> 
        <th>ID</th>
        <th>Firstname</th>
        <th>Username</th>
        <th>Email</th>
        <th>gender</th>
        <th>Phone</th>
        <th>Country</th>
        <th>Date_Registered</th>
        <th class='text-center'>Action</th>
    </tr>
";

if (mysqli_num_rows($res) == 0) { // Check if there are no rows
    $output .= "
        <tr>
            <td colspan='9' class='text-center'>No Job Request</td>
        </tr>
    ";
} else {
    while ($row = mysqli_fetch_array($res)) {
        $output .= "
            <tr>
                <td>".$row['id']."</td>
                <td>".$row['firstname']."</td>
                <td>".$row['username']."</td>
                <td>".$row['email']."</td>
                <td>".$row['gender']."</td>
                <td>".$row['phone']."</td>
                <td>".$row['country']."</td>
                <td>".$row['data_reg']."</td>
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