<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Dashboard</title>
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
                            <h4 class="my-2">Admin Dashboard</h4>
                            <div class="col-md-12 my-5">
                                <div class="row">
                                    <div class="col-md-3 bg-success mx-2" style="height:130px;">
                                    <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?php
                                                $ad=mysqli_query($conn,"select * from admin");
                                                $num=mysqli_num_rows($ad);
                                            ?>
                                                <h5 class="my-2 text-white text-center" style="font-size:30px;"><?php echo $num; ?></h5>
                                                <h5 class="text-white ">Total</h5>
                                                <h5 class="text-white ">Admin</h5>
                                        </div>

                                        <div class="col-md-4">
                                           <a href="admin.php"><i class="fa fa-users-cog fa-2x my-4" style="color: white;"></i></a> 
                                        </div>
                                    </div>
                                    </div>
                                </div>                          

                                <div class="col-md-3 bg-info mx-2" style="height:130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <?php
                                                $d=mysqli_query($conn,"select * from doctors where status='Aproved'");
                                                $num=mysqli_num_rows($d);
                                            ?>
                                                <h5 class="my-2 text-white text-center" style="font-size:30px;"><?php echo $num; ?></h5>
                                                <h5 class="text-white ">Total</h5>
                                                <h5 class="text-white "></h5>
                                        </div>

                                        <div class="col-md-4">
                                           <a href="doctor.php"><i class="fa fa-user-md fa-2x my-4" style="color: white;"></i></a> 
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-3 bg-warning mx-2" style="height:130px;">
                                

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                                    <?php
                                                        $p=mysqli_query($conn,"SELECT * FROM students");
                                                        $pp=mysqli_num_rows($p);
                                                    ?>
                                                <h5 class="my-2 text-white text-center" style="font-size:30px;"><?php echo $pp ;?></h5>
                                                <h5 class="text-white ">Total</h5>
                                                <h5 class="text-white ">Student</h5>
                                        </div>

                                        <div class="col-md-4">
                                        <a href="student.php"><i class="fa fa-graduation-cap fa-2x my-4" style="color: white;"></i></a>

                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-3 bg-danger mx-2 my-2" style="height:130px;">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?php
                                                $query="SELECT* FROM report";
                                                $res=mysqli_query($conn,$query);
                                            ?>
                                                <h5 class="my-2 text-white text-center" style="font-size:30px;"><?php echo $pp;?></h5>
                                                <h5 class="text-white ">Total</h5>
                                                <h5 class="text-white ">Report</h5>
                                        </div>

                                        <div class="col-md-4">
                                           <a href="report.php"><i class="fa-regular fa-flag fa-2x my-4" style="color: white;"></i></a> 
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-3 bg-success mx-2 my-2" style="height:130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">

                                        <?php
                                            $job=mysqli_query($conn,"SELECT * FROM doctors WHERE status='Pending'");
                                            $num1=mysqli_num_rows($job);
                                        ?>

                                                <h5 class="my-2 text-white text-center" style="font-size:30px;"><?php echo $num1 ?></h5>
                                                <h5 class="text-white ">Total</h5>
                                                <h5 class="text-white ">Improvement Request</h5>
                                        </div>

                                        <div class="col-md-4">
                                           <a href="job_request.php"><i class="fa-solid fa-file-pen fa-2x my-4" style="color: white;"></i></a> 
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="col-md-3 bg-info mx-2 my-2" style="height:130px;">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                        <?php
                                                $in="SELECT sum(amount_paid) as profit FROM income";
                                                $res=mysqli_query($conn,$in);
                                                $row=mysqli_fetch_array($res);
                                                $inc=$row['profit'];
                                            ?>
                                                <h5 class="my-2 text-white text-center" style="font-size:30px;"><?php echo  "$$inc";?></h5>
                                                <h5 class="text-white ">Total</h5>
                                                <h5 class="text-white ">Accepted</h5>
                                        </div>

                                        <div class="col-md-4">
                                           <a href="income.php"><i class="fa-solid fa-money-check-dollar fa-2x my-4" style="color: white;"></i></a> 
                                        </div>
                                    </div>
                                    </div>
                    
                                </div>



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