<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Total Doctors</title>
    </head>

    <body>
        <?php
            include("../include/header.php");
            include("../include/connect.php");
        ?>

        <div class="container-fluid">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2" style="margin-left:-30px;">
                        <?php
                        include("sidenav.php");
                        ?>
                    </div>
                    <div class="col-md-10">
                        <h5 class="text-center">Total Doctors</h5>
                    <?php
                        $query="SELECT * FROM doctors WHERE status='Aproved' ORDER BY data_reg ASC";
                        $res=mysqli_query($conn,$query);

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
        <th>Salary</th>
        <th>Date_Registered</th>
        <th>Action</th>
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
                <td>".$row['salary']."</td>
                <td>".$row['data_reg']."</td>
                <td>
                    <a href='edit.php?id=".$row['id']."'><button class='btn btn-info'>Edit</button></a>
                </td>
            </tr>
        ";
    }
}

$output .= "</table>";

echo $output; 
                    ?>

                    </div>
                </div>
            </div>
        </div>

    </body>
</html>