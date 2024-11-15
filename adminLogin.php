<?php
session_start();
include("include/connect.php");
if(isset($_POST["login"])){
    $username = $_POST["uname"];
    $password = $_POST["pass"];
    $error=array();
    if(empty($username)){
        $error["admin"] = "Enter Username";
}
else if(empty($password)){
    $error["admin"] = "Enter password";
}
if(count($error)==0){
    $sql = "select *from admin where username='$username' and password='$password' ";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)==1){
        echo "<script>alert('You have login as Admin')</script>";
        $_SESSION['admin']=$username;
        header('location:admin/index.php');
        exit();
    }
    else{
        echo "<script>alert('Invalid Username and Password')</script>";
    }
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Page</title>
    <link href="include/jkkniu.png" rel="icon">
    <!-- Include Bootstrap CSS -->
    <link href="uploads/jkkniu.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
       body {
            background-image: url('background-image.jpg'); /* Replace 'background-image.jpg' with your actual image path */
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
        }
        .jumbotron {
            margin-top: 30px;
            background-color: rgba(255, 255, 255, 0.8); /* Adjust the alpha value for transparency */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3); /* Add shadow effect */
        }
    </style>
</head>
<body>
    <?php include("include/header.php"); ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="jumbotron shadow">
                    <div class="text-center">
                        <!-- <img src="images/admin.jpeg" class="img-fluid" alt="Admin Image"> -->
                        <h3>Admin Login</h3>
                    </div>
                    
                    <div class="card mx-auto mt-5" style="max-width: 400px;">
                        <div class="card-body">
                            <form method="post" class="my-2">
                                <div>
                                    <?php
                                        if(isset($error["admin"])){
                                            $sh = $error['admin'];
                                            $show = "<h4 class='alert alert-danger'>$sh</h4>";
                                            echo $show;
                                        } else {
                                            $show = "";
                                        }
                                    ?>
                                </div>

                                <div class="form-group">
                                    <label for="uname">Username</label>
                                    <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username" value="<?php if(isset($_POST['uname'])) echo $_POST['uname'];?>">
                                </div>

                                <div class="form-group">
                                    <label for="pass">Password</label>
                                    <input type="password" name="pass" class="form-control" placeholder="Enter Password">
                                </div>

                                <input type="submit" name="login" class="btn btn-success btn-block" value="Login">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <?php 
    include("footer.php");
    ?>

    <!-- Include Bootstrap JS and Popper.js -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
