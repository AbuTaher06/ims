<?php
 include("include/connect.php");

 if(isset($_POST['create'])){
    $firstname=$_POST['firstname'];
    $username=$_POST['uname'];
    $email=$_POST['email'];
    $gender=$_POST['gender'];
    $phone=$_POST['phone'];
    $country=$_POST['country'];
    $password=$_POST['pass'];
    $confirm_password=$_POST['cpass'];
    $error=array();
    if(empty($firstname)){
        $error['ac']="Enter Firstname";
    }
    else if(empty($username)){
        $error['ac']="Enter Username";
    }
    else if(empty($email)){
        $error['ac']="Enter Email";
    }
    else if(empty($gender)){
        $error['ac']="Enter Gender";
    }
    else if(empty($phone)){
        $error['ac']="Enter Phone Number";
    }
    else if(empty($country)){
        $error['ac']="Enter Country";
    }
    else if(empty($password)){
        $error['ac']="Enter Password";
    }
    else if($password!=$confirm_password){
        $error['ac']="Both Password doesn't match";
    }
    if(count($error)==0){
            $sql="INSERT INTO students(firstname,username,email,gender,phone,country,password,data_reg,profile) VALUES('$firstname','$username','$email','$gender','$phone','$country','$password',NOW(),'students.jpg')";
            $result=mysqli_query($conn,$sql);
            if($result){
                echo "<script>alert('You have Successfully Applied')</script>";
                header("location:studentlogin.php");
            }
            else{
                echo "<script>alert('Failed to ac')</script>";
            }

    }
   
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Create Account</title>
    </head>

    <body style="background-image:url(images/studenth.jpeg); background-repeat:no-repeat; background-size:cover;">
        <?php
           
            include("include/header.php");
        ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-6 my-2 jumbotron">
                    <h5 class="text-center text-info my-2">Create Account</h5>
                    <form method="post">
                            <div class="form-group">
                                <label>Firstname</label>
                                <input type="text" name="firstname" class="form-control" autocomplete="off" placeholder="Enter Firstname" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'];?>">
                            </div>

                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username" value="<?php if(isset($_POST['uname'])) echo $_POST['uname'];?>">
                            </div>
                         
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" autocomplete="off" placeholder="Enter Email Address" value="<?php if(isset($_POST['email'])) echo $_POST['email'];?>">
                            </div>
                            <div class="form-group">
                                <label>Select Gender</label>
                                <select name="gender" class="form-gender">
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="number" name="phone" class="form-control" autocomplete="off" placeholder="Enter phone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone'];?>">
                            </div>

                            <div class="form-group">
                                <label>Select Country</label>
                                <select name="country" class="form-gender">
                                    <option value="">Select Country</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                    <option value="Pakistan">Pakistan</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Enter password">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="cpass" class="form-control" autocomplete="off" placeholder="Confirm password">
                            </div>
                            <input type="submit" name="create" value="Create Account" class="btn btn-success">
                            <p>I have already an Account?<a href="doctorLogin.php">Click Here</a></p>
                        </form>
                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </div>
    </body>
</html>