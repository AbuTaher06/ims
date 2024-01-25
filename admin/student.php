<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <!-- Your HTML file -->

    <title>Total student</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css"> <!-- Add this line to link your custom CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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
</head>

<body style="background-image:url(images/hah.jpg); background-repeat:no-repeat;">
    <?php
    include("../include/header.php");
    include("../include/connect.php")
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2" style="margin-left:-30px;">
                    <?php
                    include("sidenav.php");
                    ?>
                </div>
                <div class="col-md-10">
                    <h4 class="text-center my-3 text-primary">Total Student</h4>

                    <?php
                    // Fetch distinct sessions from the database
                    $session_query = "SELECT DISTINCT session FROM students";
                    $session_result = mysqli_query($conn, $session_query);
                    $sessions = mysqli_fetch_all($session_result, MYSQLI_ASSOC);
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

                    $query = "SELECT * FROM students";
                    if (!empty($selected_session)) {
                        // If a session is selected, add a condition to the query
                        $query .= " WHERE session = '$selected_session'";
                    }

                    $res = mysqli_query($conn, $query);

                    $output = "
                        <table class='table table-striped' id='studentTable'>
                            <thead class='custom-table-header'>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Stud_ID</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Session</th>
                                    <th>Add Result</th>
                                    <th>View Result</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";

                    if (mysqli_num_rows($res) < 1) {
                        $output .= "
                            <tr>
                                <td class='text-center' colspan='10'>No students yet</td>
                            </tr>
                        ";
                    }

                    while ($row = mysqli_fetch_array($res)) {
                        $output .= "
                            <tr>
                                <td>" . $row['id'] . "</td>
                                <td>" . $row['name'] . "</td>
                                <td>" . $row['username'] . "</td>
                                <td>" . $row['stud_id'] . "</td>
                                <td>" . $row['email'] . "</td>
                                <td>" . $row['phone'] . "</td>
                                <td>" . $row['gender'] . "</td>
                                <td>" . $row['session'] . "</td>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#studentTable').DataTable();
        });
    </script>
</body>

</html>
