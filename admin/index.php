<?php
session_start();
ob_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../adminLogin.php");
  ob_end_flush();
  exit(); 
}

$pageTitle = "Home";
include("header.php"); // Include header file
include("sidebar.php"); // Include sidebar file
include("../include/connect.php");
?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
        <li class="breadcrumb-item active"><i class="fas fa-chart-pie"></i> Dashboard</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <div class="row">
    <div class="col-lg-6 col-md-6">
      <div class="card text-center bg-warning">
        <div class="card-body">
          <?php
            $ad = mysqli_query($conn, "select * from admin");
            $num = mysqli_num_rows($ad);
          ?>
          <h5 class="card-title"><i class="fas fa-user-shield"></i> Total Admin</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;">
            <?php echo $num; ?>
          </p>
          <a href="admin.php" class="btn btn-primary"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-md-6">
      <div class="card text-center bg-danger">
        <div class="card-body">
          <?php
            $dept = mysqli_query($conn, "select * from department");
            $T_d = mysqli_num_rows($dept);
          ?>
          <h5 class="card-title"><i class="fas fa-building"></i> Total Department</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;">
            <?php echo $T_d; ?>
          </p>
          <a href="department.php" class="btn btn-primary"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div>
  </div><!-- End Dashboard Cards Row -->

</main><!-- End #main -->

<?php 
include("footer.php"); // Include footer file 
?>
