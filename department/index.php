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

$pageTitle = "Department | Dashboard";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="row">
    <div class="col-lg-4 col-md-6 ">
      <div class="card text-center bg-info">
        <div class="card-body">
          <?php
          $dept=$_SESSION['dept'];
            $ad=mysqli_query($conn,"select * from students where department='$dept'");
            $num=mysqli_num_rows($ad);
            ?>
          <h5 class="card-title">Total Student</h5>
          <p class="card-text"><?php echo $num; ?></p> <!-- Replace with dynamic count -->
          <a href="student.php" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6">
      <div class="card text-center  bg-warning">
        <div class="card-body">
        <?php
            $std=mysqli_query($conn,"select * from courses where dept_name='$dept'");
            $t_c=mysqli_num_rows($std);
            ?>
          <h5 class="card-title">Total Course</h5>
          <p class="card-text"><?php echo $t_c; ?></p> <!-- Replace with dynamic count -->
          <a href="total_course.php" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6">
      <div class="card text-center  bg-success">
        <div class="card-body">
        <?php
            $dept=mysqli_query($conn,"select * from department");
            $T_d=mysqli_num_rows($dept);
            ?>
          <h5 class="card-title">Improvement Request</h5>
          <p class="card-text"><?php echo $T_d; ?></p> <!-- Replace with dynamic count -->
          <a href="pending_request.php" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>
   
  </div><!-- End Dashboard Cards Row -->
  <div class="row">
    <div class="col-lg-4 col-md-6 ">
      <div class="card text-center bg-primary">
        <div class="card-body">
          <h5 class="card-title">Registration Request</h5>
          <p class="card-text">10</p> <!-- Replace with dynamic count -->
          <a href="student_request.php" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>


  

    <div class="col-lg-4 col-md-6">
      <div class="card text-center bg-warning">
        <div class="card-body">
        <?php
            $std=mysqli_query($conn,"select * from students where status='Pending'");
            $t_s=mysqli_num_rows($std);
            ?>
          <h5 class="card-title">Registered Students</h5>
          <p class="card-text"><?php echo $t_s; ?></p> <!-- Replace with dynamic count -->
          <a href="student.php" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>

    <div class="col-lg-4 col-md-6">
      <div class="card text-center bg-danger">
        <div class="card-body">
          <h5 class="card-title">Total Improvement</h5>
          <p class="card-text">3</p> <!-- Replace with dynamic count -->
          <a href="improvement.php" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>
  </div><!-- End Dashboard Cards Row -->

</main><!-- End #main -->

<?php 


include("footer.php"); // Include footer file 
?>
