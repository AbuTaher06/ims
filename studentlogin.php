<?php
session_start();
include("include/connect.php");

if(isset($_POST['login'])){
    $uname=$_POST['uname'];
    $password=$_POST['pass'];

    $error=array();
    $q="SELECT * FROM students WHERE username='$uname' AND password='$password'";
    $qq=mysqli_query($conn,$q);
    $row=mysqli_fetch_array($qq);
 
    if(empty($uname)){
        $error['login']="Enter Username";
    }
    else if(empty($password)){
        $error['login']="Enter Password";
    }

  
   


    if(count($error)==0){
        $sql="SELECT * FROM students WHERE username='$uname' AND password='$password'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)){
            echo "<script>alert('Done')</script>";
           
            echo "<script>alert('Done')</script>";
            header("Location:student/index.php");
            $_SESSION['student']=$uname;
            
        }else{
            echo "<script>alert('Invalid Account')</script>";
        }
    }
   
}


if(isset($error['login'])){
    $l=$error['login'];
    $show="<h5 class='text-center alert alert-danger'>$l</h5>";
}
else{
    $show="";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Patien Login page</title>
    </head>
    <body style="background-image:url(images/student.jpeg); background-repeat:no-repeat;">
        <?php
            include("include/header.php");
        ?>
        <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    
                </div>
                <div class="col-md-6 my-5 jumbotron">
                    <h5 class="text-center my-3">student Login</h5>
                    <?php
                        echo $show;
                    ?>
                        <form method="post">
                            <div class="form-group">
                            <label>Username</label>
                            <input type="text"  name="uname" class="form-control" autocomplete="off" placeholder="Enter Username" value="<?php if(isset($_POST['uname'])) echo $_POST['uname'];?>">
                            </div>
                            
                            <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="pass" class="form-control" placeholder="Enter Password">
                            </div>
<br>
                            <input type="submit" name="login" class="btn btn-success" value="login">
                            <p>Don't have any account?<a href="account.php">Register Here</a></p>
                        </form>


                </div>
                <div class="col-md-6">

                </div>
            </div>
        </div>
    </div>

    </body>
</html>