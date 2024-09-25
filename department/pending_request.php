<?php
session_start();
if (!isset($_SESSION['dept'])) {
    header("Location: ../deptlogin.php");
    exit(); 
}

include("../include/connect.php");
$dept = $_SESSION['dept'];

// Handle AJAX requests for approve/reject
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['action'])) {
    $studentId = $_POST['id'];
    $action = $_POST['action'];
    $newStatus = ($action === 'approve') ? 'Approved' : 'Rejected';

    // Use prepared statements for security
    $stmt = $conn->prepare("UPDATE imp_form SET status=? WHERE id=?");
    $stmt->bind_param("si", $newStatus, $studentId);
    
    if ($stmt->execute()) {
        echo strip_tags("Student request has been " . strtolower($newStatus) . ".");
    } else {
        echo strip_tags("Error updating record: " . $stmt->error);
    }
    $stmt->close();
    exit();
}

// HTML and other content starts here
$pageTitle = "Student";
include("header.php"); 
include("sidebar.php"); 

?>

<style>
    .awesome-header {
        background-color: #4CAF50; /* Green color */
        color: white; /* White text */
    }
    .even-row {
        background-color: #f2f2f2; /* Light gray */
    }
    .odd-row {
        background-color: #dddddd; /* Dark gray */
    }
    #messageBox {
        font-size: 1.2em;
        margin: 15px 0;
    }
    .text-success {
        color: green;
    }
    .text-danger {
        color: red;
    }
</style>

<main id="main" class="main">
<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-10">
                <h4 class="text-center my-2 text-danger">
                    Pending Request for Improvement
                    <i class="fas fa-exclamation-circle"></i>
                </h4>

                <div id="messageBox" style="display: none;"></div>

                <div class="card">
                    <div class="card-body">
                        <?php
                        $sql = "SELECT * FROM imp_form WHERE status='Pending' AND department='$dept'";
                        $res = mysqli_query($conn, $sql);

                        $output = "
                        <table class='table table-bordered'>
                            <thead class='awesome-header'>
                                <tr>   
                                    <th>Name</th>
                                    <th>Student ID</th>
                                    <th>Session</th>
                                    <th>Course Title</th>
                                    <th>Course Code</th>
                                    <th>Credit Hour</th>
                                    <th>Status</th>
                                    <th class='text-center'>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        ";

                        if (mysqli_num_rows($res) == 0) {
                            $output .= "
                            <tr>
                                <td colspan='8' class='text-center'>You have no Request</td>
                            </tr>
                            ";
                        } else {
                            $row_count = 0; // Initialize row count
                            while ($row = mysqli_fetch_assoc($res)) {
                                $course_details = json_decode($row['course_details'], true); // true for associative array
                                $courseTitle = isset($course_details[0]['courseTitle']) ? $course_details[0]['courseTitle'] : 'N/A';
                                $courseCode = isset($course_details[0]['courseCode']) ? $course_details[0]['courseCode'] : 'N/A';
                                $courseCredit = isset($course_details[0]['courseCredit']) ? $course_details[0]['courseCredit'] : 'N/A';
                                $row_class = ($row_count % 2 == 0) ? 'even-row' : 'odd-row';
                                $row_count++; // Increment row count

                                $output .= "
                                <tr class='$row_class'>
                                    <td>" . $row['student_name_english'] . "</td>
                                    <td>" . $row['exam_roll'] . "</td>
                                    <td>" . $row['current_semester'] . "</td>
                                    <td>$courseTitle</td>
                                    <td>$courseCode</td>
                                    <td>$courseCredit</td>
                                    <td><i class='fas fa-clock text-danger'></i> " . $row['status'] . "</td>
                                    <td>
                                        <button class='btn btn-success approve' data-id='" . $row['id'] . "'>Approve</button>
                                        <button class='btn btn-danger reject' data-id='" . $row['id'] . "'>Reject</button>
                                    </td>
                                </tr>
                                ";
                            }
                        }

                        $output .= "</tbody></table>";
                        echo $output;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $(document).on("click", ".approve, .reject", function() {
        var id = $(this).data("id");
        var action = $(this).hasClass('approve') ? 'approve' : 'reject';
        var button = $(this);

        if (confirm("Are you sure you want to " + action + " this request?")) {
            $.ajax({
                url: "pending_request.php", // Same file
                method: "POST",
                data: {id: id, action: action},
                success: function(response) {
                    $("#messageBox").text(response).removeClass("text-danger").addClass("text-success").show();
                    setTimeout(function() {
                        location.reload(); // Reload to reflect changes
                    }, 2000);
                },
                error: function(xhr, status, error) {
                    $("#messageBox").text("An error occurred: " + error).removeClass("text-success").addClass("text-danger").show();
                }
            });
        }
    });
});
</script>
