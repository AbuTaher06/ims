<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>student Profile</title>
    </head>

    <body style="background-image:url(images/hah.jpg); background-repeat:no-repeat;">
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
                        $student=$_SESSION['students'];
                        $query="SELECT * FROM students WHERE username='$student'";
                    
                        $res=mysqli_query($conn,$query);
                        $row=mysqli_fetch_array($res);
                    ?>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <?php
                                    if(isset($_POST['upload'])){
                                        $img=$_FILES['img']['name'];
                                        if(empty($img)){

                                        }else{
                                            $query1="UPDATE students SET profile='$img' WHERE username='$student'";
                                            $res1=mysqli_query($conn,$query1);
                                            if($res1){
                                                move_uploaded_file($_FILES['img']['tmp_name'],"img/$img");
                                            }
                                        }
                                    }
                                ?>
                                <h5>My Profile</h5>
                                <form method="post" enctype="multipart/form-data">
                                    <?php
                                         echo "<img src='img/".$row['profile']."' style='height:250px;'>";
                                    ?>
                                    <input type="file" name="img" class="form-control my-2">
                                    <input type="submit" name="upload" class="btn btn-info" value="update Profile">
                                </form>
<br>
                                <table class="table-bordered">
                                        <tr>
                                            <th colspan="2" class="text-center">My Details</th>
                                        </tr>
                                        <tr>
                                            <td>Firstname</td>
                                            <td><?php echo $row['name'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Username</td>
                                            <td><?php echo $row['username'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td><?php echo $row['email'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Phone Number</td>
                                            <td><?php echo $row['phone'];?></td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td><?php echo $row['gender'];?></td>
                                        </tr>
                                        
                                </table>
                        </div>
                            <div class="col-md-6">
                                        <h5 class="text-center">Change Username</h5>
                                        <?php
                                        if(isset($_POST['change_name'])){
                                            $uname=$_POST['uname'];
                                            if(empty($uname)){

                                            }else{
                                                $sql="UPDATE students SET username='$uname' WHERE username='$student'";
                                                    $result=mysqli_query($conn,$sql);
                                                    echo "<script>alert('Username Updated Successfully')</script>";
                                                    if($result){
                                                        $_SESSION['student']=$uname;
                                                    }
                                            }
                                        }
                                        ?>
                                        <form method="post">
                                            <label>Change Username</label>
                                            <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                                            <br>
                                            <input type="submit" name="change_name" class="btn btn-success" value="Change Username">
                            </form>

                         
                        <h5 class="text-center my-4">Change Password</h5>
                                            
                        <?php
                                    if(isset($_POST['update_pass'])){
                                        $old_pass=$_POST['old_pass'];
                                        $new_pass=$_POST['new_pass'];
                                        $con_pass=$_POST['con_pass'];

                                        $error=array();

                                        $old=mysqli_query($conn,"select * from students where username='$student'");
                                        $row=mysqli_fetch_array($old);
                                            $pass=$row['password'];
                                        
                                        if(empty($old_pass)){
                                            $error['p']="Enter old password";
                                        }
                                        else if(empty($new_pass)){
                                            $error['p']="Enter new password";
                                        }
                                        else if(empty($con_pass)){
                                            $error['p']="Confirm password";
                                        }
                                        else if($old_pass!=$pass){
                                            $error['p']="Invalid old password";
                                        }
                                        else if($new_pass!=$con_pass){
                                            $error['p']="Both  password does not match";
                                        }
                                        if(count($error)==0){
                                            $sql="UPDATE students SET password='$new_pass' WHERE username='$student'";
                                            mysqli_query($conn,$sql);
                                            echo "<script>alert('Password Updated Successfully')</script>";
                                        }
                                        
                                    }
                                    if(isset($error['p'])){
                                        $e=$error['p'];
                                        $show="<h5 class='text-center alert alert-danger'>$e</h5>";
                                    }else{
                                        $show="";
                                    }
                                 ?>


                        <div>
                            <?php
                            echo $show;
                            ?>
                        </div>
                        <form method="post">
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" name="old_pass" class="form-control" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_pass" class="form-control" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="con_pass" class="form-control" autocomplete="off"><br>
                        </div>

                        <input type="submit" name="update_pass" class="btn btn-success" value="Update Password">
                    </form>

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