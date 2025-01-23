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

$pageTitle = "Student | Profile";
include("header.php");
include("sidebar.php");
include("../include/connect.php");
?>
<!-- ... other head elements ... -->
<style>
    .custom-table-header {
        background: linear-gradient(to right, #FFA500, #FF6347); /* Gradient background */
        color: #ffffff; /* Text color */
        border: 1px solid #fff; /* Border to separate cells */
        padding: 8px 12px;
    }

    .custom-table-header a {
        color: #ffffff; /* Link color in the header */
    }

    /* Add hover effect for better user interaction */
</style>

<main id="main" class="main">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">

                <div class="col-md-10">
                    <h4 class="text-center my-3 text-primary">Total Student</h4>

                    <?php
                    $dept = $_SESSION['dept'];

                    $dept_sql = "SELECT dept_name FROM department WHERE username='$dept'";
                    $dept_res = mysqli_query($conn, $dept_sql);
                    $dept_row = mysqli_fetch_assoc($dept_res);
                    $dept_name = $dept_row['dept_name'];



                    // Fetch distinct sessions from the database
                    $session_query = "SELECT DISTINCT session FROM students WHERE department=? and status='Approved'";
                    $stmt = $conn->prepare($session_query);
                    $stmt->bind_param("s", $dept_name); // bind the department parameter
                    $stmt->execute();
                    $session_result = $stmt->get_result();
                    $sessions = $session_result->fetch_all(MYSQLI_ASSOC);
                    ?>

                    <!-- Dropdown to filter students by session -->

                    <form method="post" style="margin-bottom: 20px;">
                        <label for="session"><h3>Select session:</h3></label>
                        <select name="session" id="session" class="form-control" onchange="this.form.submit()">
                            <option value="">All Sessions</option>
                            <?php
                            foreach ($sessions as $session) {
                                $selected = ($_POST['session'] == $session['session']) ? 'selected' : '';
                                echo "<option value='{$session['session']}' $selected>{$session['session']}</option>";
                            }
                            ?>
                        </select>
                    </form>

                    <?php
                    $selected_session = isset($_POST['session']) ? $_POST['session'] : '';

                    // Build the main query
                    $query = "SELECT * FROM students WHERE department=? AND status='Approved'";
                    if (!empty($selected_session)) {
                        // Add a condition for session if selected
                        $query .= " AND session=?";
                    }

                    // Prepare the query
                    if (!empty($selected_session)) {
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("ss", $dept_name, $selected_session); // Bind both department and session
                    } else {
                        $stmt = $conn->prepare($query);
                        $stmt->bind_param("s", $dept_name); // Bind only department
                    }

                    $stmt->execute();
                    $res = $stmt->get_result();

                    $output = "
                        <table class='table table-striped' id='studentTable'>
                            <thead class='custom-table-header'>
                                <tr class='bg bg-secondary'>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Stud_ID</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Session</th>
                                    <!-- <th>Add Result</th>
                                    <th>View Result</th> -->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";

                    if ($res->num_rows < 1) {
                        $output .= "
                            <tr>
                                <td class='text-center' colspan='10'>No students yet</td>
                            </tr>
                        ";
                    }

                    while ($row = $res->fetch_assoc()) {
                        $output .= "
                            <tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['name'] . "</td>
                                <td>" . $row['username'] . "</td>
                                <td>" . $row['stud_id'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['phone'] . "</td>
                                <td>" . $row['session'] . "</td>
                                <!--
                                <td>
                                    <a href='add_result.php?id=" . $row['id'] . "&name=" . $row['username'] . "'>
                                        <button class='btn btn-primary'>Add Result</button>
                                    </a>
                                </td>
                                <td>
                                    <a href='view_result.php?id=" . $row['id'] . "&name=" . $row['username'] . "'>
                                        <button class='btn btn-success'>View Result</button>
                                    </a>
                                </td>
                                -->
                                <td>
                                    <a href='view.php?id=" . $row['id'] . "&name=" . $row['username'] . "'>
                                        <button class='btn btn-info'>View Profile</button>
                                    </a>
                                </td>
                            </tr>
                        ";
                    }

                    $output .= "
                            </tbody>
                        </table>";

                    echo $output;
                    ?>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    $(document).ready(function () {
        $('#studentTable').DataTable();
    });
</script>

<?php
include("../footer.php");
?>
