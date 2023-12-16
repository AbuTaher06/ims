<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View Students</title>
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
                        <h5 class="text-center my-3 text-primary">View student Details</h5>

                        <?php
                            if(isset($_GET['id'])){
                                $id=$_GET['id'];
                                $query="SELECT * FROM students WHERE id='$id'";
                                $res=mysqli_query($conn,$query);
                                $row=mysqli_fetch_array($res);
                            }
                        ?>
                       <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                               
                                <?php
                                         echo "<img src='../student/img/".$row['profile']."' class='col-md-12 my-2' style='height:250px;'>";
                                    ?>
                                <table class="table table-bordered">
                                    <tr>
                                    <th class="text-center bg-primary" colspan="2">Details</th>
                                    </tr>
                                    
                                    <tr class="bg-info">
                                        <td >name</td>
                                        <td><?php echo $row['name'];?></td>
                                    </tr>
                                    <tr class="bg-info">
                                        <td >stud_id</td>
                                        <td><?php echo $row['stud_id'];?></td>
                                    </tr>
                                    <tr class="bg-info">
                                        <td >Reg.No</td>
                                        <td><?php echo $row['reg_no'];?></td>
                                    </tr>
                                    <tr class="bg-info">
                                        <td>Username</td>
                                        <td><?php echo $row['username'];?></td>
                                    </tr>
                                    <tr class="bg-info">
                                        <td>Email</td>
                                        <td><?php echo $row['email'];?></td>
                                    </tr>
                                    <tr class="bg-info">
                                        <td>Phone</td>
                                        <td><?php echo $row['phone'];?></td>
                                    </tr>
                                    <tr class="bg-info">
                                        <td>Gender</td>
                                        <td><?php echo $row['gender'];?></td>
                                    </tr>
                                
                                    <tr class="bg-info">
                                        <td>Date Registered</td>
                                        <td><?php echo $row['data_reg'];?></td>
                                    </tr>
                                </table>

                            </div>
                            <div class="col-md-3">

                            </div>

                        </div>
                       </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>