<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Total Income</title>
    </head>

    <body style="background-image:url(images/hah.jpg); background-repeat:no-repeat;">
        <?php
            include("../include/header.php");
            include("../include/connect.php")
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
                    <h5 class="text-center my-3">Total Income</h5>
                    <?php
                        $query="SELECT * FROM income";
                        $res=mysqli_query($conn,$query);
                        
                        $output="";

$output = "
<table class='table table-bordered'>
    <tr> 
        <th>ID</th>
        <th>Doctor</th>
        <th>Patient</th>
        <th>Date Discharge</th>
        <th>Amount Paid</th>
    </tr>
";

if (mysqli_num_rows($res)<1) { // Check if there are no rows
    $output .= "
        <tr>
            <td colspan='5' class='text-center'>No Patient Discharge Yet</td>
        </tr>
    ";
} else {
    while ($row = mysqli_fetch_array($res)) {
        $output .= "
            <tr>
                <td>".$row['id']."</td>
                <td>".$row['doctor']."</td>
                <td>".$row['patient']."</td>
                <td>".$row['date_discharge']."</td>
                <td>".$row['amount_paid']."</td>
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