<?php 
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Student dashboard</title>
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
                        <h5 class="my-3 text-center">My Dashboard</h5>
               
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 bg-info mx-2" style="height:150px;">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="text-white my-4">My Profile</h5>
                                    </div>
                                    <div class="col-md-4">
                                            <a href="profile.php">
                                                <i class="fa fa-user-circle fa-3x my-4" style="color:white;"></i>
                                            </a>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-3 bg-warning mx-2" style="height:150px;">
                        <class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="text-white my-4">Request for improvement</h5>
                                    </div>
                                    <div class="col-md-4">
                                            <a href="improvement_form.php">
                                                <i class="fas fa-user-plus fa-3x my-4" style="color:white;"></i>
                                            </a>
                                    </div>
                                </div>
                            
                    </div>

                    </div>
                    <div class="row">
                    <div class="col-md-3 bg-danger mx-2 my-2" style="height:150px;">
                        <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="text-white my-4">My Pending Request</h5>
                                    </div>
                                    <div class="col-md-4">
                                            <a href="pending_request.php">
                                                <i class="fa fa-clock fa-3x my-4" style="color:white;"></i>
                                            </a>
                                    </div>
                                </div>
                            </div>
                    </div>
                    <div class="col-md-3 bg-success mx-2 my-2" style="height:150px;">
                        <class="col-md-12">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="text-white my-4">My Improvement</h5>
                                    </div>
                                    <div class="col-md-4">
                                            <a href="improvement.php">
                                                <i class="fas fa-check-circle fa-3x my-4" style="color:white;"></i>
                                            </a>
                                    </div>
                                </div>
                            
                    </div>
                    </div>
                        
                    </div>
                    </div>
                    <?php
                             $student=$_SESSION['students'];
                             $query="SELECT * FROM students WHERE username='$student'";
                         
                             $res=mysqli_query($conn,$query);
                             $row=mysqli_fetch_array($res);
                            $name=$row['name'];
                            $student_id=$row['stud_id'];
                            $session=$row['session'];
                        
                    
                  

                    if(isset($_POST['send'])){
                        $title = $_POST['title'];
                        $code = $_POST['code'];
                        $credit = $_POST['credit'];
                        $semester=$_POST['semester'];

                        if(empty($title) || empty($code) || empty($credit)){
                            echo "<script>alert('Please fill in all fields')</script>";
                        } else {
                            $user = $_SESSION['students'];
                            $query = "INSERT INTO improvement_requested (name,username,student_id,session,course_title, course_code, credit_hour,semester) 
                                    VALUES ('$name','$student','$student_id','$session','$title', '$code', '$credit','$semester')";
                            $res = mysqli_query($conn, $query);
                            if($res){
                                echo "<script>alert('Your request has been sent.')</script>";
                            } else {
                                echo "<script>alert('Failed to send your request.')</script>";
                            }
                        }
                    }
                ?>
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