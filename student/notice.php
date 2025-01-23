<?php
session_start();
ob_start(); 

if (!isset($_SESSION['student'])) {
    header("Location: ../studentlogin.php");
    ob_end_flush();
    exit();
}

$pageTitle = "View Notices";
include("header.php");
include("sidebar.php");
include("../include/connect.php");

// Get the authenticated student's email from session
$auth_student_email = $_SESSION['student'];

// Fetch student details from the students table
$student_query = "SELECT * FROM students WHERE email = '$auth_student_email'";
$student_result = mysqli_query($conn, $student_query);
$student = mysqli_fetch_assoc($student_result);

// Fetch notices for the authenticated student with status "Approved"
$auth_student_id = $student['stud_id']; // Get student ID from student details
$notices_query = "SELECT id, department, student_name, student_id, course_code, course_title, course_credit, year, semester, sent_date
                  FROM exam_participation_list
                  WHERE student_id = '$auth_student_id' AND status = 'Approved'
                  ORDER BY sent_date DESC";

// Execute query
$notices_result = mysqli_query($conn, $notices_query);

// Check if query is successful
if (!$notices_result) {
    die("Error fetching notices: " . mysqli_error($conn));
}
?>

<main id="main" class="main">
    <div class="pagetitle">
        <h1>Notices for <?php echo $student['name']; ?> (<?php echo $student['department']; ?> Department)</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                <li class="breadcrumb-item active">View Notices</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <div class="card-header">
                <h5>Notices Sent to You</h5>
                <a href="view_notices.php" class="btn btn-primary float-right ml-2">
                    <i class="fas fa-eye"></i> Show Notices
                </a>

                <button class="btn btn-danger float-right" onclick="downloadPDF()"><i class="fas fa-download"></i> Download as PDF</button>
            </div>

                <div class="card-body">
                    <!-- Student Info -->
                    <div class="mb-3 text-center">
                        <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
                        <p><strong>Roll No:</strong> <?php echo $student['stud_id']; ?></p>
                        <p><strong>Department:</strong> <?php echo $student['department']; ?></p>
                    </div>
                    
                    <!-- Check if notices are available -->
                    <p class="text-light bg-dark text-center rounded-30">Selected courses to which you are enabled to participate in the examination.</p>
                   
                    <?php if (mysqli_num_rows($notices_result) > 0): ?>
                        <div id="notice-table">
                            <table class="table table-bordered">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Course Code</th>
                                        <th>Course Title</th>
                                        <th>Course Credit</th>
                                        <th>Year</th>
                                        <th>Semester</th>
                                        <th>Notice Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($notices_result)): ?>
                                        <tr>
                                            <td><?php echo $row['course_code']; ?></td>
                                            <td><?php echo $row['course_title']; ?></td>
                                            <td><?php echo $row['course_credit']; ?></td>
                                            <td><?php echo $row['year']; ?></td>
                                            <td><?php echo $row['semester']; ?></td>
                                            <td><?php echo date("d-m-Y", strtotime($row['sent_date'])); ?></td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <p>No notices found for the specified criteria.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main><!-- End #main -->

<?php include("footer.php"); ?>

<script>
    function downloadPDF() {
    var { jsPDF } = window.jspdf;
    var doc = new jsPDF();
    var elementHTML = document.getElementById('notice-table');

    // Add student info
    var studentName = '<?php echo $student["name"]; ?>';
    var studentRollNo = '<?php echo $student["stud_id"]; ?>';
    var studentDepartment = '<?php echo $student["department"]; ?>';

    // Add margins and padding
    var margin = 10;
    var padding = 10;
    var pageWidth = doc.internal.pageSize.getWidth() - 2 * margin;
    var pageHeight = doc.internal.pageSize.getHeight() - 2 * margin;

    // Add logo
    var logo = new Image();
    logo.src = 'jkkniu.png'; // Replace with the actual path to your logo
    logo.onload = function() {
        doc.addImage(logo, 'PNG', pageWidth / 2 - 15, margin, 30, 30);

        // Add student info to PDF
        var y = margin + 40; // Adjust y position after the logo
        doc.setFontSize(14);
        doc.setTextColor(0, 0, 128); // Add color (dark blue)
        doc.text(pageWidth / 2, y += padding, 'Student Information', { align: 'center' });
        doc.setFontSize(12);
        doc.setTextColor(0, 0, 0); // Black color for details
        doc.text(pageWidth / 2, y += padding + 5, 'Name: ' + studentName, { align: 'center' });
        doc.text(pageWidth / 2, y += padding + 5, 'Roll No: ' + studentRollNo, { align: 'center' });
        doc.text(pageWidth / 2, y += padding + 5, 'Department: ' + studentDepartment, { align: 'center' });

        // Convert HTML to canvas and add it to the PDF
        html2canvas(elementHTML).then(function (canvas) {
            var imgData = canvas.toDataURL('image/png');
            var imgWidth = pageWidth;
            var imgHeight = canvas.height * imgWidth / canvas.width;
            var heightLeft = imgHeight;
            var position = y + 20; // Adjust position for content

            doc.addImage(imgData, 'PNG', margin, position, imgWidth, imgHeight);
            heightLeft -= pageHeight;

            while (heightLeft >= 0) {
                position = heightLeft - imgHeight + position;
                doc.addPage();
                doc.addImage(imgData, 'PNG', margin, position, imgWidth, imgHeight);
                heightLeft -= pageHeight;
            }

            doc.save('notices.pdf');
        }).catch(function (error) {
            console.error("Error generating PDF: ", error);
        });
    };
}

</script>