<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Header Navbar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-K2VvTMvLDAU2sa+9vb7/Z1oRS6x3gUq5J5Fytbx8rPU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <style>
        /* Custom CSS for login link */
.login-link {
    padding: 8px 16px; /* Adjust padding as needed */
    border-radius: 4px; /* Rounded corners */
    transition: background-color 0.3s; /* Smooth hover transition */
}

.login-link:hover {
    background-color: rgba(255, 255, 255, 0.1); /* Lighten background color on hover */
    color: #fff; /* Change text color on hover */
    text-decoration: none; /* Remove underline on hover */
}

        .navbar .navbar-brand img {
            max-height: 50px;
        }
        @media (max-width: 576px) {
            .navbar .navbar-brand img {
                max-height: 30px;
            }
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="./index.php">
            <img src="./asset/images/jkkniu.png" alt="Logo">
        </a>
        <a href="./index.php"><h5 class="text-white mb-0 mr-10">Course Improvement Management System</h5></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Login
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="./adminLogin.php">Admin</a></li>
                        <li><a class="dropdown-item" href="./deptlogin.php">Department</a></li>
                        <li><a class="dropdown-item" href="./studentlogin.php">Student</a></li>
                    </ul>
                </li>

                <!-- Add PHP code for dynamic navigation items here -->
            </ul>
        </div>
    </div>
</nav>



</body>
</html>
