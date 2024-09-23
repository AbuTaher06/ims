<?php
session_start();
ob_start();
if (!isset($_SESSION['admin'])) {
    header("Location: ../admin_login.php");
    ob_end_flush();
    exit(); 
}

$pageTitle = 'Departments';
include("header.php"); // Include header file
include("sidebar.php"); // Include sidebar file
include("../include/connect.php");
?>
<style>
    .awesome-header {
        background-color: #007bff; /* Bootstrap primary color */
        color: white; /* White text */
    }
    .even-row {
        background-color: #f2f2f2; /* Light gray */
    }
    .odd-row {
        background-color: white; /* White */
    }
</style>

<main id="main" class="main">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h4 class="text-center my-3 text-primary">
                        All Departments
                        <i class="fas fa-check-circle"></i>
                    </h4>

                    <div class="card">
                        <div class="card-body">
                            <?php
                            $sql = "SELECT * FROM department";
                            $res = mysqli_query($conn, $sql);

                            $output = "
                            <table class='table table-hover'>
                                <thead class='awesome-header'>
                                    <tr>   
                                        <th class='text-center'>Department Name</th>
                                        <th class='text-center'>Username</th>
                                        <th class='text-center'>Total Students</th>
                                        <th class='text-center'>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                            ";

                            if (mysqli_num_rows($res) == 0) {
                                $output .= "
                                <tr>
                                    <td colspan='4' class='text-center'>No Department Found</td>
                                </tr>
                                ";
                            } else {
                                $row_count = 0;
                                while ($row = mysqli_fetch_array($res)) {
                                    $dept = $row['dept_name'];
                                    $username = $row['username'];
                                    $sql1 = "SELECT * FROM students WHERE department='$dept'";
                                    $res1 = mysqli_query($conn, $sql1); 
                                    $tt = mysqli_num_rows($res1);
                                    $row_class = ($row_count % 2 == 0) ? 'even-row' : 'odd-row';
                                    $output .= "
                                    <tr class='$row_class'>
                                        <td class='text-center'><strong>" . htmlspecialchars($row['dept_name']) . "</strong></td>
                                        <td class='text-center'><strong>" . htmlspecialchars($username) . "</strong></td>
                                        <td class='text-center'><strong>$tt</strong></td>
                                        <td class='text-center'>
                                            <a href='edit_department.php?dept_name=" . urlencode($dept) . "' class='btn btn-warning btn-sm'>
                                                <i class='fas fa-edit'></i> Edit
                                            </a>
                                        </td>
                                    </tr>
                                    ";
                                    $row_count++;
                                }
                            }

                            $output .= "</tbody></table>";

                            echo $output;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
</main>
<?php
include("footer.php"); // Include footer file
?>
