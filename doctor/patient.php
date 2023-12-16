<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Total Patient</title>
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
                        <h5 class="text-center my-3">Total Patient</h5>

                        <?php
                        $query="SELECT * FROM patients";
                        $res=mysqli_query($conn,$query);
                        $output="";
                        $output.="
                            <table class='table table-bordered'>
                            <tr class='bg-secondary'>
                                <th>ID</th>
                                <th>Firstname</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>Country</th>
                                <th>Date_Reg</th>
                                <th>Action</th>
                            </tr>
                            ";
                            if(mysqli_num_rows($res)<1){
                                $output.="
                                <tr>
                                    <td class='text-center' colspan='10'>No Patient Yet</td>
                                </tr>

                                ";
                            }
                        while($row=mysqli_fetch_array($res)){
                            $output.="
                                <tr>
                                    <td>".$row['id']."</td>
                                    <td>".$row['firstname']."</td>
                                    <td>".$row['username']."</td>
                                    <td>".$row['email']."</td>
                                    <td>".$row['phone']."</td>
                                    <td>".$row['gender']."</td>
                                    <td>".$row['country']."</td>
                                    <td>".$row['data_reg']."</td>
                                    <td>
                                        <a href='view.php?id=".$row['id']."'>
                                        <button class='btn btn-info'>view</button>
                                        </a>
                                    </td>
                                
                            ";
                        }
                        $output.="
                        </tr>
                        </table
                        ";
                            echo $output;
                        ?>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>