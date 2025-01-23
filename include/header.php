<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIMS</title>
    <link href="jkkniu.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-K2VvTMvLDAU2sa+9vb7/Z1oRS6x3gUq5J5Fytbx8rPU=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"></script>
    <style>
        /* Custom CSS for login link */
        .login-link {
            padding: 12px 25px; /* Adjust padding */
            border-radius: 30px; /* Rounded corners */
            background-color: #28a745; /* Green background */
            color: white;
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
            font-size: 16px;
            transition: all 0.3s ease; /* Smooth transition for hover effect */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Shadow effect for depth */
            text-decoration: none;
        }

        /* Hover effects */
        .login-link:hover {
            background-color: #218838; /* Darker green on hover */
            transform: scale(1.05); /* Slight zoom effect */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
            color: #fff; /* Ensure text color remains white */
        }

        /* Navbar Brand Image Styling */
        .navbar .navbar-brand img {
            max-height: 50px;
        }
        .custom-dropdown-menu {
        background-color: #f8f9fa; /* Light gray background */
        border-radius: 8px; /* Rounded corners for dropdown */
        padding: 10px;
    }

    /* Individual dropdown items */
    .custom-dropdown-item {
        padding: 10px 15px; /* Space inside items */
        color: #212529; /* Text color */
        border-radius: 5px; /* Rounded corners for each item */
        transition: background-color 0.3s ease, color 0.3s ease; /* Smooth transitions */
    }

    /* Hover effect for dropdown items */
    .custom-dropdown-item:hover {
        background-color: #28a745; /* Green background on hover */
        color: white; /* White text on hover */
    }

    /* Active or focused item */
    .custom-dropdown-item:focus, .custom-dropdown-item:active {
        background-color: #218838; /* Darker green for active or focused state */
        color: white;
    }

    /* Optional: Add shadow to dropdown menu */
    .custom-dropdown-menu {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }


        @media (max-width: 576px) {
            .navbar .navbar-brand img {
                max-height: 30px;
            }
        }

        /* Navbar Link Styling */
        .navbar .nav-item .nav-link {
            font-size: 16px;
            color: white;
            transition: color 0.3s ease;
        }

        .navbar .nav-item .nav-link:hover {
            color: #f8f9fa;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-md navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand" href="./index.php">
            <img src="./asset/images/jkkniu.png" alt="Logo">
        </a>
        <a href="./index.php" class="text-decoration-none">
            <h5 class="text-white mb-0 mr-10">Course Improvement Management System</h5>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white login-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Login
            </a>
            <ul class="dropdown-menu custom-dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item custom-dropdown-item" href="./adminLogin.php">Super Admin</a></li>
                <li><a class="dropdown-item custom-dropdown-item" href="./deptlogin.php">Department</a></li>
                <li><a class="dropdown-item custom-dropdown-item" href="./examcontroller_login.php">Exam Controller</a></li>
                <li><a class="dropdown-item custom-dropdown-item" href="./studentlogin.php">Student</a></li>
            </ul>
        </li>
        <!-- Add PHP code for dynamic navigation items here -->
    </ul>
</div>

    </div>
</nav>
</body>
</html>
