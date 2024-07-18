<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Students</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .form-card {
            max-width: 500px;
            margin: auto;
            margin-top: 50px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>

    <?php
    include("../include/connect.php");
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="container">
                    <?php
                    if (isset($_GET['id'])) {
                        $student=$_SESSION['students'];
                        $id = (int)$_GET['id'];
                        $query = "SELECT * FROM students WHERE id='$id' and name='$student'";
                        $res = mysqli_query($conn, $query);
                        $row = mysqli_fetch_array($res);
                        $roll = $row['stud_id'];
                    }
                    ?>

                    <?php
                    if (isset($_GET['id'])) {
                        $id = (int)$_GET['id'];
                        $query = "SELECT * FROM result WHERE st_id='$roll'";
                        $res1 = mysqli_query($conn, $query);
                        $row1 = mysqli_fetch_array($res1);
                    }
                    ?>

                    <div class="form-card jumbotron bg-info">
                        <h5 class="text-center">Request for improvement</h5>

                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $name = $row['name'];
                            $email = $row['email'];
                            $roll_no = $row['stud_id'];
                            $reg_no = $row['reg_no'];
                            $session = $row['session'];
                            $semester = $_POST['semester'];
                            $course_code = $_POST['course_code'];
                            $course_name = $_POST['course_name'];
                            $credit_hour = $_POST['credit_hour'];

                            // Determine the academic year from the semester
                            $year_title = '';

                            if (strpos($semester, '1_') === 0) {
                                $year_title = 'First Year';
                            } elseif (strpos($semester, '2_') === 0) {
                                $year_title = 'Second Year';
                            } elseif (strpos($semester, '3_') === 0) {
                                $year_title = 'Third Year';
                            } elseif (strpos($semester, '4_') === 0) {
                                $year_title = 'Fourth Year';
                            }

                            // Check total credit for the selected year
                            $query = "
                                SELECT
                                    CASE
                                        WHEN semester LIKE '1_1' OR semester LIKE '1_2' THEN 'First Year'
                                        WHEN semester LIKE '2_1' OR semester LIKE '2_2' THEN 'Second Year'
                                        WHEN semester LIKE '3_1' OR semester LIKE '3_2' THEN 'Third Year'
                                        WHEN semester LIKE '4_1' OR semester LIKE '4_2' THEN 'Fourth Year'
                                    END AS year_title,
                                    COALESCE(SUM(credit_hour), 0) AS total_credit_hour
                                FROM improve_students
                                WHERE roll_no = '$roll_no'
                                GROUP BY year_title
                            ";

                            $result = mysqli_query($conn, $query);

                            // Check if insertion is allowed for the selected year
                            $insertion_allowed = true;

                            while ($total_credit_row = mysqli_fetch_assoc($result)) {
                                // Check if the current year corresponds to the year being inserted
                                if ($total_credit_row['year_title'] === $year_title && ($total_credit_row['total_credit_hour'] + $credit_hour) > 6.0) {
                                    $insertion_allowed = false;
                                    break;
                                }
                            }

                            // Display message based on insertion allowance
                            if (!$insertion_allowed) {
                                echo "<div class='result-message alert alert-danger' role='alert'>Improvement is not allowed. Total credit for the selected year exceeds 6.0.</div>";
                            } else {
                                // Insert data into the database
                                $res = mysqli_query($conn, "INSERT INTO improve_students(name,email,semester,roll_no,reg_no,session,course_code,course_name,credit_hour) VALUES ('$name','$email','$semester','$roll_no','$reg_no','$session','$course_code', '$course_name','$credit_hour')");

                                if ($res) {
                                    echo "<div class='result-message alert alert-success' role='alert'>Marks successfully inserted!</div>";
                                } else {
                                    echo "<div class='result-message alert alert-danger' role='alert'>Failed to insert data: " . mysqli_error($conn) . "</div>";
                                }
                            }
                        }
                        ?>

                        <form action="" method="POST">
                            <!-- Form fields... -->
                            <div class="form-group">
                                <label for="semester">Semester:</label>
                                <select class="form-control" id="semester" name="semester" required>
                                    <option value="1_1">1-1</option>
                                    <option value="1_2">1-2</option>
                                    <option value="2_1">2-1</option>
                                    <option value="2_2">2-2</option>
                                    <option value="3_1">3-1</option>
                                    <option value="3_2">3-2</option>
                                    <option value="4_1">4-1</option>
                                    <option value="4_2">4-2</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="course_code">Course Code:</label>
                                <input type="text" class="form-control" id="course_code" name="course_code" required>
                            </div>
                            <div class="form-group">
                                <label for="course_name">Course Name:</label>
                                <input type="text" class="form-control" id="course_name" name="course_name" required>
                            </div>
                            <div class="form-group">
                                <label for="credit_hour">Credit Hour:</label>
                                <input type="text" class="form-control" id="credit_hour" name="credit_hour" required>
                            </div>
                            <button type="submit" class="btn btn-success btn-block">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
