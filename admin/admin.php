<?php
session_start();
include("../include/connect.php");

// Handling Admin Removal
if (isset($_POST['admin_id'])) {
    $id = $_POST['admin_id'];
    $sql = "DELETE FROM admin WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <?php
    include("header.php");
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
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-center">All Admin</h5>

                                <?php
                                $ad = $_SESSION['admin'];
                                $sql = "SELECT * FROM admin WHERE username !='$ad'";
                                $result = mysqli_query($conn, $sql);
                                $output = "
                                <table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th style='width:10%;'>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                                if (mysqli_num_rows($result) < 1) {
                                    $output .= "<tr><td colspan='3' class='text-center'>No new Admin</td></tr>";
                                }

                                while ($row = mysqli_fetch_array($result)) {
                                    $id = $row["id"];
                                    $username = $row['username'];
                                    $output .= "
                                        <tr>
                                            <td>$id</td>
                                            <td>$username</td>
                                            <td>
                                                <form method='post'>
                                                    <input type='hidden' name='admin_id' value='$id'>
                                                    <button type='submit' class='btn btn-danger'>Remove</button>
                                                </form>
                                            </td>
                                        ";
                                }

                                $output .= " </tr></tbody></table>";
                                echo $output;
                                ?>
                            </div>

                            <div class="col-md-6">
                                <?php
                                if(isset($_POST['add'])) {
                                    $uname = $_POST['uname'];
                                    $pass= $_POST['pass'];
                                    $image= $_FILES['img']['name'];
                                    $error=array();
                                    if(empty($uname)) {
                                        $error['u'] = 'Enter Admin Username';
                                    }
                                    else if(empty($pass)) { 
                                        $error['u'] = 'Enter Admin Password';
                                    }
                                    else if(empty($image)) {
                                        $error['u'] = 'Add Admin Picture';
                                    }
                                    if(count($error) == 0) {
                                        $sql="INSERT INTO admin(username,password,profile) VALUES('$uname','$pass','$image')";
                                        $result = mysqli_query($conn, $sql);    
                                        if($result) {
                                            move_uploaded_file($_FILES['img']['tmp_name'],"img/$image");
                                           
                              }
                                        else{
                                            echo "Error adding admin: " . mysqli_error($conn);
                                        }
                                    }
                                }

                                if(isset($error['u'])) {
                                    $er = $error['u'];
                                    $show="<h5 class='text-center alert alert-danger'>$er</h5></h5>";
                                }
                                else{
                                    $show="";
                                }
                                ?>
                                <h5 class="text-center">Add Admin</h5>
                                <form method="post" enctype="multipart/form-data">
                                    <?php echo $show; ?>
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" name="uname" class="form-control" autocomplete="off">
                                    </div>

                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" name="pass" class="form-control">
                                    </div>

                                    <div class="form-group">
                                        <label>Add Admin Picture</label>
                                        <input type="file" name="img" class="form-control">
                                    </div><br>
                                    <input type="submit" name="add" value="Add New Admin" class="btn btn-success">
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
