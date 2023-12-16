<?php
    session_start();
    error_reporting(0);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Doctor's Profile Page</title>
    </head>
    <body>
        <?php
            include("../include/header.php");
        ?>

         

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left:-30px;">
                    <?php
                    include("sidenav.php");
                    include("../include/connect.php");
                    ?>
                </div>
                <div class="col-md-10">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            $doc=$_SESSION['doctor'];
                                $query="SELECT * FROM doctors WHERE username='$doc'";
                                $res=mysqli_query($conn,$query);
                                $row=mysqli_fetch_array($res);
                                if(isset($_POST['upload'])){
                                    $img=$_FILES['img']['name'];

                                    if(empty($img)){

                                    }else{
                                        $query="UPDATE doctors SET profile='$img' WHERE username='$doc'";
                                        $res=mysqli_query($conn,$query);
                                        if($res){
                                            move_uploaded_file($_FILES['img']['tmp_name'],"img/$img");
                                        }
                                    }


                                }
                            ?>

                            <form method="post" enctype="multipart/form-data">
                                <?php
                                echo "<img src='img/".$row['profile']."' style='height:250px;'>";
                                ?>
                                <input type="file" name="img" class="form-control">
                                <input type="submit" name="upload" class="btn btn-success" value="Update profile">
                            </form>
                            <div class="my-3">
                                <table class="table-bordered">
                                    <tr>
                                        <th colspan="2" class="text-center">Details</th>
                                    </tr>
                                    <tr>
                                        <td>FirstName</td>
                                        <td><?php echo $row['firstname'];?></td>
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
                                        <td>Phone No.</td>
                                        <td><?php echo $row['phone'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Gender.</td>
                                        <td><?php echo $row['gender'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td><?php echo $row['country'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Salary</td>
                                        <td><?php echo "$".$row['salary'];?></td>
                                    </tr>
                                   
                                    
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h5 class="text-center">Update Profile</h5>
                            <?php
                                        if(isset($_POST['change_name'])){
                                            $uname=$_POST['uname'];
                                            if(empty($uname)){

                                            }else{
                                                $sql="UPDATE doctors SET username='$uname' WHERE username='$doc'";
                                                    $result=mysqli_query($conn,$sql);
                                                    if($result){
                                                        $_SESSION['doctors']=$uname;
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

                            <br><br>

                            <form method="post">
                        <h5 class="text-center my-4">Change Password</h5>
                                            
                        <?php
                                    if(isset($_POST['update_pass'])){
                                        $old_pass=$_POST['old_pass'];
                                        $new_pass=$_POST['new_pass'];
                                        $con_pass=$_POST['con_pass'];

                                        $error=array();

                                        $old=mysqli_query($conn,"select * from doctors where username='$doc'");
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
                                            $sql="UPDATE doctors SET password='$new_pass' WHERE username='$doc'";
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

                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" name="old_pass" class="form-control" autocomplete="off"><br>
                        </div>

                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_pass" class="form-control" autocomplete="off"><br>
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="con_pass" class="form-control" autocomplete="off"><br>
                        </div>

                        <input type="submit" name="update_pass" class="btn btn-secondary" value="Update Password">
                    </form>


                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
    </div>
    </body>
</html>