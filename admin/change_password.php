<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Profile</title>
    </head>
    <body>
        <?php
            include("../include/connect.php");
            $ad=$_SESSION['admin'];
            $sql="SELECT * FROM admin WHERE username='$ad'";
            $result=mysqli_query($conn,$sql);
            while($row=mysqli_fetch_array($result)){
                $username=$row["username"];
                
            }
                                    if(isset($_POST['update_pass'])){
                                        $old_pass=$_POST['old_pass'];
                                        $new_pass=$_POST['new_pass'];
                                        $con_pass=$_POST['con_pass'];

                                        $error=array();

                                        $old=mysqli_query($conn,"select * from admin where username='$ad' ");
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
                                            $sql="UPDATE admin SET password='$new_pass' WHERE username='$ad'";
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

                                 <form method="post">
                                    <h5 class="text-center my-4">Change Password</h5>

                                    <div>
                                    <?php
                                        echo $show;
                                    ?>
                                    </div>
                                    
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
                                    <input type="password" name="con_pass" class="form-control" autocomplete="off">
    
                                    </div>

                                    <input type="submit" name="update_pass" class="btn btn-success" value="Update Password">

                                 </form>
    </body>
</html>