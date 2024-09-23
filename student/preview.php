<?php 
session_start();
require_once("../include/connect.php");
$email = $_SESSION['student']; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submission Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        @page {
            size: auto;
            margin: 10mm; /* Adjust margins */
        }
        @media print {
            #printbtn {
                display: none !important; /* Hide print button */
            }
            header, .sidebar {
                display: none !important; /* Hide header and sidebar */
            }
            body {
                margin: 0;
                padding: 0;
            }
            .main-heading {
                font-size: 30px !important;
            }
            .underline {
                line-height: 27px !important;
                text-decoration-style: dotted !important;
            }
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <?php 
    $sql = "SELECT count(*) FROM imp_form WHERE email='$email'"; 
    $result = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($result)[0];

    if ($count == 0) {
        echo 'No submission found for this email. Kindly fill up the <a href="form.php">submission form</a>.';
    } else {
    ?>
    <div class="row">
        <div class="col-sm-1"></div>
        <div class="col-sm-10" style="border: 2px solid black; padding: 10px;">
            <?php 
            $sql = "SELECT * FROM imp_form WHERE email='$email'"; 
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_array($result);
            // Decode JSON data for course details
            $courseDetails = json_decode($row['course_details'], true);
            ?>
            <div class="row">
                <div class="col-2 text-center">
                    <img src="./img/jkkniu.png" class="img-fluid" style="height: 100px; width: auto;">
                </div>
                <div class="col">
                    <div class="main-heading">জাতীয় কবি কাজী নজরুল ইসলাম বিশ্ববিদ্যালয়</div>
                    <p class="sub-heading">ত্রিশাল, ময়মনসিংহ ২২২৪</p>
                    <p class="email">Email: <?php echo $email; ?></p>
                </div>
                <div class="col-sm-12">
                    <hr class="hrcls"> 
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 text-center">
                    <h3><u>Submission Form</u></h3>
                </div>
            </div>

            <div class="row">
                <div class="col-6">
                    <div class="form-group row">
                        <div class="col-4">
                            <label class="lable">Department:</label>
                        </div>
                        <div class="col-8">
                            <strong><?php echo $row['department']; ?></strong>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label class="lable">Full Name (Bangla):</label>
                        </div>
                        <div class="col-8">
                            <strong><?php echo $row['student_name_bangla']; ?></strong>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label class="lable">Full Name (English):</label>
                        </div>
                        <div class="col-8">
                            <strong><?php echo $row['student_name_english']; ?></strong>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label class="lable">Email:</label>
                        </div>
                        <div class="col-8">
                            <strong><?php echo $row['email']; ?></strong>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label class="lable">Mobile No:</label>
                        </div>
                        <div class="col-8">
                            <strong><?php echo $row['mobile_number']; ?></strong>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label class="lable">Father Name:</label>
                        </div>
                        <div class="col-8">
                            <strong><?php echo $row['father_name']; ?></strong>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-4">
                            <label class="lable">Mother Name:</label>
                        </div>
                        <div class="col-8">
                            <strong><?php echo $row['mother_name']; ?></strong>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <div class="row">
                        <div class="col-12">
                            <label class="lable">Photo:</label>
                            <div style="width: 150px;">
                                <img src="uploads/<?php echo $row['signature']; ?>" width="150" height="150">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <h4 class="text-center mt-4">Course Details</h4>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Serial No</th>
                        <th>Year</th>
                        <th>Semester</th>
                        <th>Course Code</th>
                        <th>Course Credit</th>
                        <th>Course Title</th>
                        <th>GPA Obtained</th>
                        <th>Exam Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($courseDetails as $course) { ?>
                    <tr>
                        <td><?php echo $course['serialNo']; ?></td>
                        <td><?php echo $course['year']; ?></td>
                        <td><?php echo $course['semester']; ?></td>
                        <td><?php echo $course['courseCode']; ?></td>
                        <td><?php echo $course['courseCredit']; ?></td>
                        <td><?php echo $course['courseTitle']; ?></td>
                        <td><?php echo $course['gpaObtained']; ?></td>
                        <td><?php echo $course['examType']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <br>
            <center><button type="button" class="btn btn-warning" id="printbtn" onclick="window.print()">Print Form</button></center>
            <br>
        </div>
        <div class="col-1"></div>
    </div>
    <?php } ?>
</div>
</body>
</html>
