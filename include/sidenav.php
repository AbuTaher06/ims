<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
       body {
            margin: 0;
            font-family: 'Arial', sans-serif;
        }

        .sidebar {
            height: 100vh;
            background-color: #343a40;
            padding-top: 20px;
            color: #fff;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar li {
            padding: 10px;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
        }

        .sidebar a:hover {
            color: #007bff;
        }

        .spcl {
            font-weight: bold;
        }

        /* Added style for indentation */
        .sidebar ul ul {
            padding-left: 20px; /* Adjust the value to increase or decrease the indentation */
        }
    </style>
</head>
<body>

<!-- sidenav.php -->

<div class="sidebar">
    <ul>
        <li><span class="spcl"><i class="fa fa-server" aria-hidden="true"></i> Administrator</span>
            <ul>
                <li><a href="adminLogin.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
            </ul>
        </li>

        <li><span class="spcl"><i class="fa fa-male" aria-hidden="true"></i> Department Area</span>
            <ul>
                <li><a href="facultylogin.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
                <li><a href="fct_single_profile.php"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
            </ul>
        </li>

        <li><span class="spcl"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Student Area</span>
            <ul>
                <li><a href="studentlogin.php"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
                <li><a href="st_reg.php"><i class="fa fa-user-plus" aria-hidden="true"></i> Register</a></li>
                <li><a href="../student/profile.php"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-outdent" aria-hidden="true"></i> Result</a></li>
            </ul>
        </li>
    </ul>
</div>

<style>
    .sidebar {
        height: 100vh;
        background-color: #343a40;
        padding-top: 20px;
        color: #fff;
    }

    .sidebar ul {
        list-style: none;
        padding: 0;
    }

    .sidebar li {
        padding: 5px; /* Adjusted padding for reduced space */
    }

    .sidebar a {
        color: #fff;
        text-decoration: none;
    }

    .sidebar a:hover {
        color: #007bff;
    }

    .spcl {
        font-weight: bold;
        color: #ffc107; /* Add the desired color for the span */
    }
</style>

</body>
</html>
