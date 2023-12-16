<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js" integrity="sha512-uKQ39gEGiyUJl4AI6L+ekBdGKpGw4xJ55+xyJG7YFlJokPNYegn9KwQ3P8A7aFQAUtUsAQHep+d/lrGqrbPIDQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-info bg-info">
        <img src="../images/jkkniu.png" height="50px" alt="" class="mx-1">
        <img src="include/jkkniu.png" height="50px" alt="" class="mx-1">
        

        <h5 class="text-white"><a href="index.php" style="text-decoration: none; color: white;">Improvement Management System</a></h5>
    <div class="mr-auto"></div>

    <ul class="navbar nav">
        <!-- <li class="nav-item"><a href="#" class="nav-link text-white">Admin</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white">Doctor</a></li>
        <li class="nav-item"><a href="#" class="nav-link text-white">student</a></li> -->
        <?php
if (isset($_SESSION['admin'])) {
    $user = $_SESSION['admin'];
    echo '
    <li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>
    <li class="nav-item"><a href="../admin/logout.php" class="nav-link text-white"><i class="fas fa-sign-out-alt"></i> Logout</a></li> 
    ';
} elseif (isset($_SESSION['doctor'])) {
    $user = $_SESSION['doctor'];
    echo '
    <li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>
    <li class="nav-item"><a href="../doctor/logout.php" class="nav-link text-white"><i class="fas fa-sign-out-alt"></i> Logout</a></li> 
    ';
} elseif (isset($_SESSION['student'])) {
    $user = $_SESSION['student'];
    echo '
    <li class="nav-item"><a href="#" class="nav-link text-white">'.$user.'</a></li>
    <li class="nav-item"><a href="../student/logout.php" class="nav-link text-white"><i class="fas fa-sign-out-alt"></i> Logout</a></li> 
    ';
} else {
    echo '
    <li class="nav-item"><a href="index.php" class="nav-link text-white">Home</a></li> ';
    // <li class="nav-item"><a href="adminLogin.php" class="nav-link text-white">Admin</a></li>
    // <li class="nav-item"><a href="doctorLogin.php" class="nav-link text-white">Doctor</a></li>
    // <li class="nav-item"><a href="studentlogin.php" class="nav-link text-white">Student</a></li>
    
    
}
?>

    </ul>
    </nav>
</body>
</html>