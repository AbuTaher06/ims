<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Students</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .profile-image {
            width: 90%;
            max-width: 300px;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .improvement-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            color:chartreuse
           
        }

        .improvement-link:hover {
            color: #007bff;
        }

    </style>
</head>

<body>

    <?php
    include("../include/header.php");
    include("../include/connect.php")
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php include("sidenav.php"); ?>
            </div>
            <div class="col-md-10">
                <h5 class="text-center my-3 text-primary">View student Details</h5>

                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $query = "SELECT * FROM students WHERE id='$id'";
                    $res = mysqli_query($conn, $query);
                    $row = mysqli_fetch_array($res);
                }
                ?>

                <div class="col-md-12 profile-section">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <?php echo "<img src='../student/img/" . $row['profile'] . "' class='profile-image'>";  ?>
                            <table class="table table-bordered ">
                                <tr>
                                    <th class="text-center" colspan="2">Details</th>
                                </tr>
                                <tr>
                                    <td>name</td>
                                    <td><?php echo $row['name']; ?></td>
                                </tr>
                                <tr>
                                    <td>stud_id</td>
                                    <td><?php echo $row['stud_id']; ?></td>
                                </tr>
                                <tr>
                                    <td>Reg.No</td>
                                    <td><?php echo $row['reg_no']; ?></td>
                                </tr>
                                <tr>
                                    <td>Username</td>
                                    <td><?php echo $row['username']; ?></td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td><?php echo $row['email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td><?php echo $row['phone']; ?></td>
                                </tr>
                                <tr>
                                    <td>Gender</td>
                                    <td><?php echo $row['gender']; ?></td>
                                </tr>
                                <tr>
                                    <td>Date Registered</td>
                                    <td><?php echo $row['data_reg']; ?></td>
                                </tr>
                            </table>

                            <h3><a href="#" class="improvement-link">Check Improvement Status</a></h3>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
