<?php
// session_start();
// ob_start();
// if (!isset($_SESSION['email'])) {
//   header("Location: ../studentlogin.php");
//   ob_end_flush();
//   exit(); 
// }

$pageTitle = "Student Dashboard";
include("header.php"); // Include header file
include("sidebar.php"); // Include sidebar file
include("../include/connect.php");

$email = $_SESSION['student'];
$req_sql = "select * from students where email='$email'";
$r = mysqli_query($conn, $req_sql);
$row = mysqli_fetch_array($r);
$id = $row['stud_id'];

$pending_sql = "select * from exam_requests where student_id='$id' AND status='Pending'";
$p = mysqli_query($conn, $pending_sql);
$t_p = mysqli_num_rows($p);

$accepted_sql = "select * from exam_requests where student_id='$id' AND status='Approved'";
$a = mysqli_query($conn, $accepted_sql);
$t_a = mysqli_num_rows($a);

// Assuming you have a value for improvement
$total_improvement = 0; // Replace with actual calculation if needed

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
    <div class="col-lg-4 col-md-6">
      <div class="card text-center bg-warning">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-hourglass-half"></i> Pending Request</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;"><?php echo $t_p; ?></p>
          <a href="pending_exam.php" class="btn btn-primary"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card text-center bg-success">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-check-circle"></i> Accepted Request</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;"><?php echo $t_a; ?></p>
          <a href="selected.php" class="btn btn-primary"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="card text-center bg-info">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-chart-line"></i> Total Improvement</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;"><?php echo $total_improvement; ?></p>
          <a href="improvement.php" class="btn btn-primary"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div>
  </div><!-- End Dashboard Cards Row -->

</main><!-- End #main -->

<?php 
include("footer.php"); // Include footer file 
?>
