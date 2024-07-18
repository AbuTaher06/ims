<?php
session_start();

// Include database connection
include("../include/connect.php");
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
    include("header.php");
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2" style="margin-left: -30px;">
                <?php include("sidenav.php"); ?>
            </div>

            <div class="col-md-10">
                <div class="container">
                    <?php
                    $student = $_SESSION['students'];
                    $q = "SELECT * FROM students WHERE username='$student'";
                    $res = mysqli_query($conn, $q);
                    $r = mysqli_fetch_array($res);
                    $student_id = $r['stud_id'];

                    $qq = "SELECT * FROM imp_form WHERE exam_roll='$student_id'";
                    $rq = mysqli_query($conn, $qq);
                    $r1 = mysqli_fetch_array($rq);
                    ?>
                    <div>
                        <p style="text-align:center;color:#fff;background:purple;margin:0;padding:8px;width:100%"><?php echo "Name: " . $r['name'] . "<br>Student ID: " . $r['stud_id'] . "<br>Session: " . $r['session']; ?></p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center" style="color:#fff;background:orange;margin:0 px,50 px,0 px,50 px;padding:8px;">Total Credit Improvement Taken</h5>
                            <?php
                            $query = "SELECT * FROM imp_form WHERE exam_roll='$student_id'";
                            $result = mysqli_query($conn, $query);

                            if ($result && mysqli_num_rows($result) > 0) {
                                // Initialize academic year variable
                                $current_academic_year = null;

                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Parse course details
                                    $course_details = json_decode($row['course_details'], true);
                                    if ($course_details && count($course_details) > 0) {
                                        // Check if any field within course details is not empty
                                        $notEmptyDetails = false;
                                        foreach ($course_details as $course) {
                                            if (!empty($course['serialNo']) || !empty($course['semester']) || !empty($course['courseNo']) || !empty($course['courseTitle']) || !empty($course['gradeObtained'])) {
                                                $notEmptyDetails = true;
                                                break;
                                            }
                                        }

                                        // Display academic year and course details if not empty
                                        if ($notEmptyDetails) {
                                            // Check if the academic year has changed
                                            $semester = $course_details[0]['semester'];
                                            $academic_year = ceil($semester / 2);
                                            if ($academic_year !== $current_academic_year) {
                                                // Display academic year title
                                                echo "<p><strong>Academic Year:</strong> " . $academic_year . "</p>";
                                                $current_academic_year = $academic_year;
                                            }

                                            // Display course details
                                            echo "<ul>";
                                            foreach ($course_details as $course) {
                                                if (!empty($course['serialNo']) || !empty($course['semester']) || !empty($course['courseNo']) || !empty($course['courseTitle']) || !empty($course['gradeObtained'])) {
                                                    echo "<li><strong>Semester:</strong> " . $course['semester'] . ", <strong>Course Code:</strong> " . $course['courseNo'] . ", <strong>Course Name:</strong> " . $course['courseTitle'] . " , <strong>Credit Hour:</strong> " . $course['gradeObtained'] . "</li>";
                                                }
                                            }
                                            echo "</ul>";
                                        }
                                    }
                                }
                            } else {
                                echo "<p>No data available.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
    include("../footer.php")
    ?>
</body>

</html>
