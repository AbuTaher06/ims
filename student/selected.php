<?php
session_start();
$pageTitle = "Accepted Request";
include("header.php"); // Include header file
include("sidebar.php"); // Include sidebar file
include("../include/connect.php");
?>

<style>
    .form-card {
        max-width: 500px;
        margin: auto;
        margin-top: 50px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    table {
        width: 100%;
        margin-bottom: 20px;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        border: 1px solid #ddd;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
</style>

<main id="main" class="main">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10">
                <div class="container">
                    <?php
                    $email = $_SESSION['student'];
                    $q = "SELECT * FROM students WHERE email=?";
                    $stmt = mysqli_prepare($conn, $q);
                    mysqli_stmt_bind_param($stmt, 's', $email);
                    mysqli_stmt_execute($stmt);
                    $res = mysqli_stmt_get_result($stmt);
                    $r = mysqli_fetch_array($res);

                    $qq = "SELECT * FROM imp_form WHERE email=?";
                    $stmt = mysqli_prepare($conn, $qq);
                    mysqli_stmt_bind_param($stmt, 's', $email);
                    mysqli_stmt_execute($stmt);
                    $rq = mysqli_stmt_get_result($stmt);
                    ?>
                    <div>
                        <p style="text-align:center;color:#fff;background:purple;margin:0;padding:8px;width:100%">
                            <?php echo "Name: " . htmlspecialchars($r['name']) . "<br>Student ID: " . htmlspecialchars($r['stud_id']) . "<br>Session: " . htmlspecialchars($r['session']); ?>
                        </p>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center" style="color:#fff;background:orange;margin:0;padding:8px;">Total Improved Credit Hour</h5>
                            <?php
                            $query = "SELECT * FROM imp_form WHERE email=? and status='Approved'";
                            $stmt = mysqli_prepare($conn, $query);
                            mysqli_stmt_bind_param($stmt, 's', $email);
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            // Initialize an array to group courses by academic year
                            $courses_by_year = [];

                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    // Parse course details
                                    $course_details = json_decode($row['course_details'], true);
                                    if ($course_details && count($course_details) > 0) {
                                        foreach ($course_details as $course) {
                                            if (!empty($course['year'])) {
                                                // Group by academic year
                                                $academic_year = htmlspecialchars($course['year']);
                                                $courses_by_year[$academic_year][] = [
                                                    'semester' => htmlspecialchars($course['semester']),
                                                    'courseCode' => htmlspecialchars($course['courseCode']),
                                                    'courseTitle' => htmlspecialchars($course['courseTitle']),
                                                    'courseCredit' => htmlspecialchars($course['courseCredit']),
                                                    'gpaObtained' => htmlspecialchars($course['gpaObtained'])
                                                ];
                                            }
                                        }
                                    }
                                }

                                // Display courses grouped by academic year
                                foreach ($courses_by_year as $academic_year => $courses) {
                                    echo "<h6><strong>Academic Year:</strong> " . $academic_year . "</h6>";
                                    echo "<table>";
                                    echo "<thead><tr>
                                            <th class='bg-info'>Semester</th>
                                            <th class='bg-info'>Course Code</th>
                                            <th class='bg-info'>Course Name</th>
                                            <th class='bg-info'>Credit Hour</th>
                                            <th class='bg-info'>GPA Obtained</th>
                                        </tr></thead>";
                                    echo "<tbody>";
                                    foreach ($courses as $course) {
                                        echo "<tr>
                                                <td>" . $course['semester'] . "</td>
                                                <td>" . $course['courseCode'] . "</td>
                                                <td>" . $course['courseTitle'] . "</td>
                                                <td>" . $course['courseCredit'] . "</td>
                                                <td>" . $course['gpaObtained'] . "</td>
                                              </tr>";
                                    }
                                    echo "</tbody></table>";
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
</main>
<?php include("footer.php"); ?>
