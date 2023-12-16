<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Total student</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
     .custom-table-header {
            background-color:#FFA500; /* Customize the background color */
            color: #ffffff; /* Customize the text color */
        }

        .custom-table-header a {
            color: #ffffff; /* Customize the link color in the header */
        }

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
                    // Fetch distinct countries from the database
                    $session_query = "SELECT DISTINCT session FROM students";
                    $session_result = mysqli_query($conn, $session_query);
                    $countries = mysqli_fetch_all($session_result, MYSQLI_ASSOC);
                    ?>

                    <!-- Dropdown to filter students by session -->
                    <form method="post" style="margin-bottom: 20px;">
                        <label for="session">Select session:</label>
                        <select name="session" id="session" class="form-control" onchange="this.form.submit()">
                            <option value="">All Session</option>
                            <?php
                            foreach ($countries as $session) {
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
                        <table class='table table-bordered'>
                            <tr class='custom-table-header'>
                                <th>ID</th>
                                <th>name</th>
                                <th>Username</th>
                                <th>Stud_ID</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Gender</th>
                                <th>session</th>
                                <th>Add Result</th>
                                <th>View result</th>
                                <th>Action</th>
                            </tr>
                        ";

                    if (mysqli_num_rows($res) < 1) {
                        $output .= "
                            <tr>
                                <td class='text-center' colspan='10'>No student Yet</td>
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
                                <a href='add_result.php?id=". $row['id'] . "name=" . $row['username'] . "'>
                                        <button class='btn btn-primary'>Add Result</button>
                                    </a>
                                </td>
                                <td>
                                <a href='view_result.php?id=". $row['id'] . "name=" . $row['username'] . "'>
                                        <button class='btn btn-success'>View Result</button>
                                    </a>
                                </td>
                                <td>
                                    <a href='view.php?id=". $row['id'] . "name=" . $row['username'] . "'>
                                        <button class='btn btn-info'>View Profile</button>
                                    </a>
                                </td>
                            ";
                    }

                    $output .= "
                        </tr>
                    </table>";

                    echo $output;
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
