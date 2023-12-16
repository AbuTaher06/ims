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
                        <h5 class="text-center my-2">Book Appointmnet</h5>
                        <?php
                        $stu=$_SESSION['student'];
                            $sel=mysqli_query($conn,"SELECT * FROM students WHERE username='$stu'");
                            $row=mysqli_fetch_array($sel);
                            $firstname=$row['firstname'];
                            $surename=$row['username'];
                            $gender=$row['gender'];
                            $phone=$row['phone'];
                            if(isset($_POST['book'])){
                                $date=$_POST['date'];
                                $sym=$_POST['sym'];
                                if(empty($sym)){

                                }else{
                                    $query="INSERT INTO appointment(firstname, surename, gender, phone, appointment_date, symptoms, status, date_booked) VALUES('$firstname','$surename','$gender','$phone','$date','$sym','Pending',NOW())";
                                    $res=mysqli_query($conn,$query);
                                    if($res){
                                        echo "<script>alert('You have booked an appointment')</script>";
                                    }
                                }
                            }
                        ?>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-6 jumbotron bg-info">
                                    <form method="post">
                                        <label>Appointment Date</label>
                                        <input type="date" name="date" class="form-control">
                                        <label>Symptoms</label>
                                        <input type="text" name="sym" class="form-control" autocomplete="off" placeholder="Enter Symptoms">
<br>
                                        <input type="submit" name="book" class="btn btn-success text-center my-2" value="Book Appointment">


                                    </form>
                                </div>
                                <div class="col-md-3">

                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>