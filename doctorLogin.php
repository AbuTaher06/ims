<?php
session_start();

include("include/connect.php");

if(isset($_POST['login'])){
    $uname=$_POST['uname'];
    $password=$_POST['pass'];

    $error=array();
    $q="SELECT * FROM doctors WHERE username='$uname' AND password='$password'";
    $qq=mysqli_query($conn,$q);
    $row=mysqli_fetch_array($qq);
 
    if(empty($uname)){
        $error['login']="Enter Username";
    }
    else if(empty($password)){
        $error['login']="Enter Password";
    }

    else if($row['status']=="Pending"){
        $error['login']="Please wait for the Admin to Confirm";
    }
    else if($row['status']=="Rejected"){
        $error['login']="Try Again Later";
    }


    if(count($error)==0){
        $sql="SELECT * FROM doctors WHERE username='$uname' AND password='$password'";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)){
            echo "<script>alert('Done')</script>";
            $_SESSION['doctor']=$uname;
            header("Location:doctor/index.php");
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
<html lang="en">
<head>
    <title>Doctor Login page</title>
    <style>
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('../images/cse.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container-fluid {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            padding: 30px;
            text-align: center;
        }

        .container-fluid form {
            max-width: 300px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            margin-top: 5px;
            transition: border-color 0.3s ease;
        }

        .form-group input:hover,
        .form-group input:focus {
            border-color: #007bff;
        }

        .form-group button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
        }

        .form-group button:hover {
            background-color: #0056b3;
        }

        p {
            margin-top: 15px;
            font-size: 14px;
        }

        p a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
        }

        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php include("include/header.php"); ?>
    <div class="container-fluid">
        <h2>Doctors Login</h2>
        <?php echo $show; ?>

        <!-- Placeholder form -->
        <form method="post">
            <div class="form-group">
                <input type="text" name="uname" placeholder="Username" class="form-control" autocomplete="off" value="<?php if(isset($_POST['uname'])) echo $_POST['uname'];?>">
            </div>
            <div class="form-group">
                <input type="password" name="pass" placeholder="Password" class="form-control">
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            <p>Don't have any account? <a href="apply.php">Apply now</a></p>
        </form>
    </div>
</body>
</html>
