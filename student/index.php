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
<?php 
$email=$_SESSION['student'];
$pending_sql="select * from imp_form where email='$email' AND status='Pending'";
$p=mysqli_query($conn,$pending_sql);
$t_p=mysqli_num_rows($p);

$accpet_sql="select * from imp_form where email='$email' AND status='Approved'";
$a=mysqli_query($conn,$accpet_sql);
$t_a=mysqli_num_rows($a);

?>
    <div class="col-lg-4 col-md-6">
      <div class="card text-center bg-warning">
        <div class="card-body">
          <h5 class="card-title">Pending</h5>
          <p class="card-text"><?php echo $t_p; ?></p> <!-- Replace with dynamic count -->
          <a href="pending_request.php" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card text-center  bg-success">
        <div class="card-body">
          <h5 class="card-title">Accepted</h5>
          <p class="card-text"><?php echo $t_a; ?></p> <!-- Replace with dynamic count -->
          <a href="improvement.php" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6 ">
      <div class="card text-center bg-info">
        <div class="card-body">
          <h5 class="card-title">Requested</h5>
          <p class="card-text">10</p> <!-- Replace with dynamic count -->
          <a href="#" class="btn btn-primary">View Details</a>
        </div>
      </div>
    </div>
   
  </div><!-- End Dashboard Cards Row -->

</main><!-- End #main -->

<?php 
include("footer.php"); // Include footer file 
?>
