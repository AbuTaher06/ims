<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark  bg-success">
    <div class="container">
        <!-- Brand Logo -->
        <a class="navbar-brand" href="./index.php">
            <img src="../asset/images/jkkniu.png" alt="Logo" style="height: 40px;"> <!-- Set height to control logo size -->
        </a>
        
        <!-- Navbar Toggler for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Content (Collapsible on mobile screens) -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <!-- Title aligned next to the brand logo -->
            <span class="navbar-text mx-auto">
                <h5 class="text-white mb-0">Course Improvement Management System</h5>
            </span>
        </div>
    </div>
</nav>

<!-- Bootstrap JS (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
