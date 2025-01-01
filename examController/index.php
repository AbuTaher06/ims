<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();
if (!isset($_SESSION['controller'])) { // Check for controller session
    header("Location: ../controllerlogin.php");
    ob_end_flush();
    exit(); 
}

$pageTitle = "Exam Controller | Dashboard";
include("header.php"); 
include("sidebar.php"); 
include("../include/connect.php");
?>
<style>
.bg-purple {
    background-color: #6f42c1; /* A vibrant purple */
    color: white; /* Ensure text is readable */
}

.marquee {
    display: inline-block;
    white-space: nowrap;
    animation: scroll 5s linear infinite; /* Adjust the duration as needed */
}

@keyframes scroll {
    0% {
        transform: translateX(100%); /* Start from right */
    }
    100% {
        transform: translateX(-100%); /* Move all the way to left */
    }
}
</style>

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

  <div class="col text-center">
      <div class="alert" style="background: linear-gradient(90deg, #1a1a1a, #000000); color: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.4); overflow: hidden;">
          <div class="marquee">
              <h3 class="text-center" style="margin: 0; font-weight: bold; font-size: 24px; text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);">
                  EXAM CONTROLLER DASHBOARD
              </h3>
          </div>
      </div>
  </div>

  <div class="row">
    <!-- Pending Exam Participation Requests -->
    <div class="col-lg-3 col-md-6">
      <div class="card text-center bg-secondary">
        <div class="card-body">
          <?php
          $pending_requests = mysqli_query($conn, "SELECT * FROM exam_participation_list WHERE reviewed_by_controller = 0");
          $pending_count = mysqli_num_rows($pending_requests);
          ?>
          <h5 class="card-title"><i class="fas fa-hourglass-half"></i> Pending Exam Requests</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;"><?php echo $pending_count; ?></p>
          <a href="pending.php" class="btn btn-light"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div>

    <!-- Review Exam Requests -->
    <div class="col-lg-3 col-md-6">
      <div class="card text-center bg-warning">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-edit"></i> Review Exam Requests</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;">Click to Review</p>
          <a href="review.php" class="btn btn-primary"><i class="fas fa-eye"></i> Go to Review</a>
        </div>
      </div>
    </div>

    <!-- Approved Exam Requests -->
    <div class="col-lg-3 col-md-6">
      <div class="card text-center bg-success">
        <div class="card-body">
          <?php
          $approved_requests = mysqli_query($conn, "SELECT * FROM exam_participation_list WHERE reviewed_by_controller = 1 AND status = 'Approved'");
          $approved_count = mysqli_num_rows($approved_requests);
          ?>
          <h5 class="card-title"><i class="fas fa-check-circle"></i> Approved Exam Requests</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;"><?php echo $approved_count; ?></p>
          <a href="approved_exam_requests.php" class="btn btn-light"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div>

    <!-- Rejected Exam Requests -->
    <div class="col-lg-3 col-md-6">
      <div class="card text-center bg-danger">
        <div class="card-body">
          <?php
          $rejected_requests = mysqli_query($conn, "SELECT * FROM exam_participation_list WHERE reviewed_by_controller = 1 AND status = 'Rejected'");
          $rejected_count = mysqli_num_rows($rejected_requests);
          ?>
          <h5 class="card-title"><i class="fas fa-times-circle"></i> Rejected Exam Requests</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;"><?php echo $rejected_count; ?></p>
          <a href="rejected_exam_requests.php" class="btn btn-light"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div>
  </div><!-- End Dashboard Cards Row -->

</main><!-- End #main -->

<?php include("footer.php"); ?>
