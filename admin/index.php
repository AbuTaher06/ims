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
        include("header.php");
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

                                
                                <div class="col-md-3 bg-warning mx-2" style="height:130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">

                                        <?php
                                            $job=mysqli_query($conn,"SELECT * FROM students WHERE status='Pending'");
                                            $num1=mysqli_num_rows($job);
                                        ?>

                                                <h5 class="my-2 text-white text-center" style="font-size:30px;"><?php echo $num1 ?></h5>
                                                <h5 class="text-white ">Add </h5>
                                                <h5 class="text-white ">Department</h5>
                                        </div>

                                        <div class="col-md-4">
                                           <a href="add_department.php"><i class="fa-solid fa-file-pen fa-2x my-4" style="color: white;"></i></a> 
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                </div>
                              

                                <!-- <div class="col-md-3 bg-info mx-2" style="height:130px;">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">

                                        <?php
                                            $job=mysqli_query($conn,"SELECT * FROM improvement_requested WHERE status='Pending'");
                                            $num1=mysqli_num_rows($job);
                                        ?>

                                                <h5 class="my-2 text-white text-center" style="font-size:30px;"><?php echo $num1 ?></h5>
                                                <h5 class="text-white ">Improvement</h5>
                                                <h5 class="text-white ">Request</h5>
                                        </div>

                                        <div class="col-md-4">
                                           <a href="imp.php"><i class="fa-solid fa-file-pen fa-2x my-4" style="color: white;"></i></a> 
                                        </div>
                                    </div>
                                    </div>
                                </div> -->

                                

                                <div class="col-md-12 my-5">
                                <div class="row">

                                
                                <div class="col-md-3 bg-primary mx-2" style="height:130px;">
                                

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                                    <?php
                                                        $p=mysqli_query($conn,"SELECT * FROM department");
                                                        $pp=mysqli_num_rows($p);
                                                    ?>
                                                <h5 class="my-2 text-white text-center" style="font-size:30px;"><?php echo $pp ;?></h5>
                                                <h5 class="text-white ">Total</h5>
                                                <h5 class="text-white ">Department</h5>
                                        </div>

                                        <div class="col-md-4">
                                        <a href="department.php"><i class="fa fa-graduation-cap fa-2x my-4" style="color: white;"></i></a>

                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-3 bg-success mx-2" style="height:130px;">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                       
                                                <h5 class="my-2 text-white text-center" style="font-size:30px;"></h5>
                                                <h5 class="text-white ">Add</h5>
                                                <h5 class="text-white ">Student</h5>
                                        </div>

                                        <div class="col-md-4">
                                            <a href="add_student.php"><i class="fas fa-user-plus fa-2x my-4" style="color: white;"></i></a>
                                        </div>

                                    </div>
                                    </div>
                    
                                </div>


                                <!-- <div class="col-md-3 bg-danger mx-2 my-2" style="height:130px;">

                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <?php
                                                $query="SELECT* FROM improvement_requested where status='Approved'";
                                                $res=mysqli_query($conn,$query);
                                                $ta=mysqli_num_rows($res);
                                            ?>
                                                <h5 class="my-2 text-white text-center" style="font-size:30px;"><?php echo $ta;?></h5>
                                                <h5 class="text-white ">Improvement</h5>
                                                <h5 class="text-white ">Accepted</h5>
                                        </div>

                                        <div class="col-md-4">
                                           <a href="accepted_request.php"><i class="fa-solid fa-check-circle fa-2x my-4" style="color: white;"></i></a> 
                                        </div>
                                    </div>
                                    </div> 
                                </div> -->



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                           
      <?php
             include("../footer.php");
      ?>


<script>
        $(document).ready(function() {
            // Function to check logout status
            function checkLogoutStatus() {
                $.ajax({
                    url: 'check_logout.php', // Path to the server-side script to check logout status
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.logout) {
                            // If logout status is true, redirect to login page
                            window.location.href = '../adminLogin.php';
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            }

            // Call the function initially
            checkLogoutStatus();

            // Periodically check for logout status every 30 seconds
            setInterval(checkLogoutStatus, 30000); // 30 seconds
        });
    </script>
    </body>
</html>