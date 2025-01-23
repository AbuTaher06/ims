<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
ob_start();
if (!isset($_SESSION['student'])) {
  header("Location: ../studentlogin.php");
  ob_end_flush();
  exit(); 
}
?>
<?php

include("../include/connect.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo isset($pageTitle) ? $pageTitle : 'Default Title'; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <!-- Favicons -->
  <link href="../asset/images/jkkniu.png" rel="icon">
  
  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="../admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../admin/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../admin/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../admin/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../admin/assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <!-- Template Main CSS File -->
  <link href="../admin/assets/css/style.css" rel="stylesheet">
</head>
<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
      <a href="index.php" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">Course Improvement Management System
        </span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div> -->
    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle" href="#"><i class="bi bi-search"></i></a>
        </li>
        <li class="nav-item dropdown">
          <?php
        //  $email = $student['email'];
          $query = "SELECT * FROM students WHERE status = 'Pending'";
          $result = mysqli_query($conn, $query);
          $num = mysqli_num_rows($result);
          ?>
          <a class="nav-link nav-icon" href="" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number"><?php echo $num; ?></span>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <?php
            echo '<li class="dropdown-header">You have ' . $num . ' new notifications';
            echo '<a href="view_reports.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a></li>';
            ?>
            <li><hr class="dropdown-divider"></li>
            <!-- <li class="dropdown-footer">
              <a href="#">Your Complaint is Approved</a>
            </li> -->
          </ul>
        </li>
      
        <?php
        $email=$_SESSION['student'];
        $sql="select * from students where email='$email'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        ?>
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="users-profile.php" data-bs-toggle="dropdown">
        <img src="../admin/uploads/<?php echo $row['profile']; ?>" alt="Profile" class="rounded-circle">

          <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $row['name'];?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6><?php echo $row['name'];?></h6>
            
          </li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="users-profile.php">
              <i class="bi bi-person"></i>
              <span>My Profile</span>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="pages-contact.php">
              <i class="bi bi-question-circle"></i>
              <span>Need Help?</span>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="logout.php">
              <i class="bi bi-box-arrow-right"></i>
              <span>Sign Out</span>
            </a>
          </li>
        </ul>
      </ul>
    </nav>
  </header>
  <!-- End Header -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<!-- Vendor JS Files -->
 <!-- Add this to header.php -->
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>
 <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>


<script src="../admin/assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="../admin/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../admin/assets/vendor/chart.js/chart.umd.js"></script>
<script src="../admin/assets/vendor/echarts/echarts.min.js"></script>
<script src="../admin/assets/vendor/quill/quill.js"></script>
<script src="../admin/assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="../admin/assets/vendor/tinymce/tinymce.min.js"></script>
<script src="../admin/assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="../admin/assets/js/main.js"></script>
<!-- Add this to header.php -->



</body>

</html>
