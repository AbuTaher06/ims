<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor's Dashboard</title>
 
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

                <div class="container-fluid">
                    <div class="col-md-12 my-5">
                    <h4 class="my-2">Doctor Dashboard</h4>
                     <div class="row">
                     
    <div class="col-md-3 mx-2 bg-info" style="height:150px;">
    
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                <h5 class="text-white"><br>My Profile</h5>
            </div>
            <div class="col-md-4">
                <a href="profile.php"><i class="fa fa-user-circle fa-3x my-4" style="color:white;"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="col-md-3 mx-2 bg-warning" style="height:150px;">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-8">
                         <?php
                            $p=mysqli_query($conn,"SELECT * FROM patients");
                            $pp=mysqli_num_rows($p);
                        ?>
                <h5 class="text-white my-2" style="font-size:30px;"><?php echo $pp;?></h5>
                <h5 class="text-white">Total</h5>
                <h5 class="text-white">Patient</h5>
            </div>
            <div class="col-md-4">
                <a href="patient.php"><i class="fa fa-procedures fa-3x my-4" style="color:white;"></i></a>
            </div>
        </div>
    </div>
</div>

<div class="col-md-3 mx-2 bg-success" style="height:150px;">
    <div class="col-md-12">

        <div class="row">
            <div class="col-md-8">
            <?php
                            $a=mysqli_query($conn,"SELECT * FROM appointment WHERE status='Pending'");
                            $aa=mysqli_num_rows($a);
                        ?>
                <h5 class="my-2 text-white text-center" style="font-size:30px;"><?php echo $aa;?></h5>
                <h5 class="text-white">Total</h5>
                <h5 class="text-white">Appointment</h5>
            </div>
            <div class="col-md-4">
                <a href="appointment.php"><i class="fa fa-calendar fa-3x my-4" style="color:white;"></i></a>
            </div>
        </div>
    </div>
</div>

                <div class="col-md-10">

                </div>
            </div>

                </div>
            </div>
        </div>
    </div>

</body>
</html>