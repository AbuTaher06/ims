<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>student Invoice</title>
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
                        <h5 class="text-center my-2">My Invoice</h5>
                        <?php
                            $pat=$_SESSION['student'];
                            $query="SELECT * FROM students WHERE username='$pat'";
                            $res=mysqli_query($conn,$query);
                            $row=mysqli_fetch_array($res);
                            $fname=$row['firstname'];
                            $in=mysqli_query($conn,"SELECT * FROM income WHERE student='$fname'");

                            $output="";
                            $output.="
                            <table class='table table-bordered'>
                            <tr class='bg-secondary'>
                                <th>ID</th>
                                <th>Doctor</th>
                                <th>student</th>
                                <th>Date Discharge</th>
                                <th>Amount Paid</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            ";
                            if(mysqli_num_rows($in)<1){
                                $output.="
                                <tr>
                                    <td class='text-center' colspan='6'>No Invoice Yet</td>
                                </tr>

                                ";
                            }
                        while($row=mysqli_fetch_array($in)){
                            $output.="
                                <tr>
                                    <td>".$row['id']."</td>
                                    <td>".$row['doctor']."</td>
                                    <td>".$row['student']."</td>
                                    <td>".$row['date_discharge']."</td>
                                    <td>".$row['amount_paid']."</td>
                                    <td>".$row['description']."</td>
                                 <td>
                                    <a href='view.php?id=".$row['id']."'>
                                    <button class='btn btn-info'>View</button>
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