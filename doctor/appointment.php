<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create Account</title>
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
                    <h5 class="text-center my-2">Total Appointment</h5>
                    <?php
                    $query="SELECT * FROM appointment WHERE status='Pending'";
                    $res=mysqli_query($conn,$query);

                    $output="";
                        $output.="
                            <table class='table table-bordered'>
                            <tr class='bg-secondary'>
                                <th>ID</th>
                                <th>Firstname</th>
                                <th>Username</th>
                                <th>Gender</th>
                                <th>Phone</th>
                                <th>Appointment Date</th>
                                <th>Symptoms</th>
                                <th>Status</th>
                                <th>Date Booked</th>
                                <th>Action</th>
                            </tr>
                            ";
                            if(mysqli_num_rows($res)<1){
                                $output.="
                                <tr>
                                    <td class='text-center' colspan='10'>No Apppointment Yet</td>
                                </tr>

                                ";
                            }
                        while($row=mysqli_fetch_array($res)){
                            $output.="
                                <tr>
                                    <td>".$row['id']."</td>
                                    <td>".$row['firstname']."</td>
                                    <td>".$row['surename']."</td>
                                    <td>".$row['gender']."</td>
                                    <td>".$row['phone']."</td>
                                    <td>".$row['appointment_date']."</td>
                                    <td>".$row['symptoms']."</td>
                                    <td>".$row['status']."</td>
                                    <td>".$row['date_booked']."</td>
                                    <td>
                                        <a href='discharge.php?id=".$row['id']."'><button class='btn btn-info'>Check</button></a>
                                    </td>
                            ";
                        }
                        $output.="
                        </tr>
                        </table
                        ";
                            echo $output;
                        ?>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>