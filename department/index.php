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
$dept = $_SESSION['dept'];

$dept_sql="SELECT dept_name FROM department WHERE username='$dept'";
$dept_res=mysqli_query($conn,$dept_sql);
$dept_row=mysqli_fetch_assoc($dept_res);
$dept_name=$dept_row['dept_name'];
?>
<style>
.bg-purple {
    background-color: #6f42c1; /* A vibrant purple */
    color: white; /* Ensure text is readable */
}

.marquee {
    display: inline-block;
    white-space: nowrap;
    animation: scroll 10s linear infinite; /* Adjust the duration as needed */
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
         <?php echo $dept_name; ?> Department 
      </h3>
    </div>
  </div>
</div>

  <div class="row">
    <!-- Registration Requests -->
    <div class="col-lg-4 col-md-6">
      <div class="card text-center bg-primary">
        <div class="card-body">
        <?php
          $dept = $_SESSION['dept'];
          $tr = mysqli_query($conn, "SELECT * FROM students WHERE department='$dept_name' AND status='pending'");
          $r = mysqli_num_rows($tr);
          ?>
          <h5 class="card-title"><i class="fas fa-user-plus"></i> Registration Request</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;"><?php echo $r ?></p> <!-- Replace with dynamic count -->
          <a href="student_request.php" class="btn btn-light"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div>

       
      <!-- Exam Participation Requests (Row 1) -->
      <div class="col-lg-4 col-md-6">
      <div class="card text-center bg-secondary">
        <div class="card-body">
          <?php
          $primary_request = mysqli_query($conn, "SELECT * FROM exam_requests WHERE sent_from_department='pending' AND department='$dept'");
          $primary_count = mysqli_num_rows($primary_request);
          ?>
          <h5 class="card-title"><i class="fas fa-clipboard-check"></i> Pending Improvemnt Application</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;"><?php echo $primary_count; ?></p>
          <a href="exam_participation_request.php" class="btn btn-light"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div>
<!-- Total Students -->
<div class="col-lg-4 col-md-6 ">
      <div class="card text-center bg-info">
        <div class="card-body">
          <?php
          $dept = $_SESSION['dept'];
          $review_status = mysqli_query($conn, "SELECT * FROM exam_requests WHERE sent_from_department<>'pending' and (sent_to_department='approved' OR sent_to_department='rejected')  AND department='$dept'");
          $num = mysqli_num_rows($review_status);        
          ?>
          <h5 class="card-title"><i class="fas fa-check-circle"></i> Status of Improvement Application</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;"><?php echo $num; ?></p> 
          <a href="review_status.php" class="btn btn-light"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div>
    
  </div><!-- End Dashboard Cards Row -->

  <div class="row">


   <!-- Registered Students -->
   <div class="col-lg-4 col-md-6">
      <div class="card text-center bg-danger">
        <div class="card-body">
          <?php
          $std = mysqli_query($conn, "SELECT * FROM students WHERE department='$dept_name' AND status='Approved'");
          $t_s = mysqli_num_rows($std);
          ?>
          <h5 class="card-title"><i class="fas fa-user-graduate"></i> Registered Students</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;"><?php echo $t_s; ?></p> 
          <a href="student.php" class="btn btn-primary"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div>
 
         <!-- Total Courses -->
         <!-- <div class="col-lg-4 col-md-6">
      <div class="card text-center bg-warning">
        <div class="card-body">
          <?php
          $std = mysqli_query($conn, "SELECT * FROM courses WHERE dept_name='$dept'");
          $t_c = mysqli_num_rows($std);
          ?>
          <h5 class="card-title"><i class="fas fa-book"></i> Total Course</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;"><?php echo $t_c; ?></p> 
          <a href="total_course.php" class="btn btn-primary"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div> -->

    <!-- Selected for Improvement Requests (Row 1) -->
    <div class="col-lg-4 col-md-6">
      <div class="card text-center bg-success">
        <div class="card-body">
          <?php
          $selected_for_improvement = mysqli_query($conn, "SELECT * FROM exam_requests WHERE sent_from_department='sent' AND reviewed_by_controller='1' and sent_to_department='approved' AND department='$dept'");
          $selected_count = mysqli_num_rows($selected_for_improvement);
          ?>
          <h5 class="card-title"><i class="fas fa-thumbs-up"></i> Selected for Improvement</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;"><?php echo $selected_count; ?></p>
          <a href="selected_for_improvement.php" class="btn btn-primary"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div>

   <!-- Rejected for Improvement Requests (Row 1) -->
    <div class="col-lg-4 col-md-6">
        <div class="card text-center bg-warning">
          <div class="card-body">
            <?php
            $rejected_for_improvement = mysqli_query($conn, "SELECT * FROM exam_requests WHERE sent_to_department='rejected' AND reviewed_by_controller='1' and sent_from_department='sent'  AND department='$dept'");
            $rejected_count = mysqli_num_rows($rejected_for_improvement);
            ?>
            <h5 class="card-title"><i class="fas fa-thumbs-down"></i> Rejected for Improvement</h5>
            <p class="card-text" style="font-size: 24px; font-weight: bold;"><?php echo $rejected_count; ?></p>
            <a href="rejected_for_improvement.php" class="btn btn-primary"><i class="fas fa-eye"></i> View Details</a>
          </div>
        </div>
      </div>

  </div><!-- End Dashboard Cards Row -->

  <!-- <div class="row">
   
    <div class="col-lg-6 col-md-6">
      <div class="card text-center bg-purple">
        <div class="card-body">
          <?php
          // $T_d = mysqli_query($conn, "SELECT * FROM exam_requests WHERE status='pending' AND department='$dept'");
          // $improvement_count = mysqli_num_rows($T_d);
          // ?>
          <h5 class="card-title"><i class="fas fa-exclamation-circle"></i> Improvement Exam Request</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;">0</p> 
          <a href="pending_request.php" class="btn btn-light"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div>
-->
    <!-- Total Improvement -->

    <!-- <div class="col-lg-6 col-md-6">
      <div class="card text-center bg-danger">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-chart-line"></i> Improvement Results</h5>
          <p class="card-text" style="font-size: 24px; font-weight: bold;">0</p> 
          <a href="improvementg.php" class="btn btn-light"><i class="fas fa-eye"></i> View Details</a>
        </div>
      </div>
    </div> 

  </div> -->
 

</main><!-- End #main -->

<?php include("footer.php"); ?>
