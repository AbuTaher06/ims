<?php

/*
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
ob_start();
if (!isset($_SESSION['email'])) {
  header("Location: ../studentlogin.php");
  ob_end_flush();
  exit(); 
}
*/

$pageTitle = "Home";
include("header.php"); // Include header file
include("sidebar.php"); // Include sidebar file
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
    <div class="col-lg-6 col-md-6 ">
      <div class="card text-center bg-info">
        <div class="card-body">
          <?php
            $ad=mysqli_query($conn,"select * from admin");
            $num=mysqli_num_rows($ad);
            ?>
          <h5 class="card-title">Total Admin</h5>
          <p class="card-text"><?php echo $num; ?></p> <!-- Replace with dynamic count -->
          <a href="admin.php" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-md-6">
      <div class="card text-center  bg-success">
        <div class="card-body">
        <?php
            $dept=mysqli_query($conn,"select * from department");
            $T_d=mysqli_num_rows($dept);
            ?>
          <h5 class="card-title">Total Department</h5>
          <p class="card-text"><?php echo $T_d; ?></p> <!-- Replace with dynamic count -->
          <a href="department.php" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>



</main><!-- End #main -->

<?php 
include("footer.php"); // Include footer file 
?>
