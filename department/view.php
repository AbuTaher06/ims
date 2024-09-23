<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
ob_start();
if (!isset($_SESSION['dept'])) {
  header("Location: ../deptlogin.php");
  ob_end_flush();
  exit(); 
}

$pageTitle = "Student";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");
$dept=$_SESSION['dept'];

?>

    <style>
        .profile-image {
            width: 90%;
            max-width: 300px;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
<main id="main" class="main">
    <div class="container-fluid">
        <div class="row">
            
            <div class="col-md-10">
                

                <?php
                if (isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $query = "SELECT * FROM students WHERE id='$id'";
                    $res = mysqli_query($conn, $query);
                    $row = mysqli_fetch_array($res);
                }
                ?>
                <h5 class="text-center my-3 text-primary"><?php echo $row['name']."'s" ?> Details</h5>
              

                <div class="col-md-12 profile-section">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6 text-center">
                            <div class="card">
                                <div class="card-body">
                                    <?php echo "<img src='../student/img/" . $row['profile'] . "' class='profile-image'>";  ?>
                                    <table class="table table-bordered ">
                                        <tr>
                                            <th class="text-center" colspan="2">Details</th>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td><?php echo $row['name']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Student ID</td>
                                            <td><?php echo $row['stud_id']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Reg. No</td>
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

                                 <!--   <a href='add_for_imp.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['username']; ?>'>
                                        <button class='btn btn-success'>Add for improvement</button>
                                    </a>   --!>
                                      
                                    <a href='imp_info.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['username']; ?>'>
                                        <button class='btn btn-primary'>Check Previous Improvement</button>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php 
include('footer.php');
?>
