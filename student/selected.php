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
                    $dept_name = $r['department'];
                    $stud_id = $r['stud_id'];

                    $dept_sql = "SELECT * FROM department WHERE dept_name='$dept_name'";
                    $dept_res = mysqli_query($conn, $dept_sql);
                    $dept_row = mysqli_fetch_assoc($dept_res);
                    $dept = $dept_row['username'];

                    $qq = "SELECT * FROM `exam_requests` WHERE department=? AND student_id=? AND sent_from_department='sent' AND reviewed_by_controller='1' AND sent_to_department='sent'";
                    $stmt = mysqli_prepare($conn, $qq);
                    mysqli_stmt_bind_param($stmt, 'ss', $dept, $stud_id);  // Correct binding of two string parameters
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
                            <h5 class="card-title text-center" style="color:#fff;background:orange;margin:0;padding:8px;">Exam Requests</h5>
                            <?php
                            if ($rq && mysqli_num_rows($rq) > 0) {
                                echo "<table>";
                                echo "<thead>
                                        <tr>
                                            <th>Course Code</th>
                                            <th>Course Title</th>
                                            <th>Credit Hour</th>
                                            <th>Year</th>
                                            <th>Semester</th>
                                            <th>Request Date</th>
                                            <th>Transcript</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>";
                                echo "<tbody>";
                                while ($row = mysqli_fetch_assoc($rq)) {
                                    $status = $row['reviewed_by_controller'] ? "Reviewed" : "Pending";
                                    echo "<tr>
                                            <td>" . htmlspecialchars($row['course_code']) . "</td>
                                            <td>" . htmlspecialchars($row['course_title']) . "</td>
                                            <td>" . htmlspecialchars($row['course_credit']) . "</td>
                                            <td>" . htmlspecialchars($row['year']) . "</td>
                                            <td>" . htmlspecialchars($row['semester']) . "</td>
                                            <td>" . htmlspecialchars($row['request_date']) . "</td>
                                            <td><a href='" . htmlspecialchars($row['transcript_path']) . "' target='_blank'>View</a></td>
                                            <td>" . $status . "</td>
                                        </tr>";
                                }
                                echo "</tbody></table>";
                            } else {
                                echo "<p>No exam requests found.</p>";
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
