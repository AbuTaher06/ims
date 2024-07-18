<?php
session_start();
$dept=$_SESSION['dept'];
include("../include/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['id']) && isset($_POST['action'])) {
        $studentId = $_POST['id'];
        $action = $_POST['action'];

        // Perform action based on the button clicked
        if ($action === 'approve') {
            // Update the status of the student to 'Approved' in the database
            $updateSql = "UPDATE students SET status='Approved' WHERE id='$studentId'";
            if (mysqli_query($conn, $updateSql)) {
                echo "Student approved successfully";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } elseif ($action === 'reject') {
            // Update the status of the student to 'Rejected' in the database
            $updateSql = "UPDATE students SET status='Rejected' WHERE id='$studentId'";
            if (mysqli_query($conn, $updateSql)) {
                echo "Student rejected successfully";
            } else {
                echo "Error updating record: " . mysqli_error($conn);
            }
        } else {
            echo "Invalid action";
        }
    } else {
        echo "Missing parameters";
    }
    exit; // Terminate the script after handling the AJAX request
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Requests</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

  <h2 class="mb-0 text-center bg-info">
    <i class="fas fa-exclamation-circle"></i> Pending Student Request
  </h2>
<?php
$sql="SELECT * FROM students WHERE status='Pending' AND department='$dept' ORDER BY data_reg ASC";
$res = mysqli_query($conn, $sql);

$output = "
<table class='table table-bordered'>
    <tr> 
        <th>ID</th>
        <th>Name</th>
        <th>Username</th>
        <th>Stud_ID</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Gender</th>
        <th>Session</th>
        <th class='text-center'>Action</th>
    </tr>
";

if (mysqli_num_rows($res) == 0) { // Check if there are no rows
    $output .= "
        <tr>
            <td colspan='9' class='text-center'>No Pending Request</td>
        </tr>
    ";
} else {
    while ($row = mysqli_fetch_array($res)) {
        $output .= "
            <tr>
                <td>".$row['id']."</td>
                <td>".$row['name']."</td>
                <td>".$row['username']."</td>
                <td>".$row['stud_id']."</td>
                <td>".$row['email']."</td>
                <td>".$row['phone']."</td>
                <td>".$row['gender']."</td>
                <td>".$row['session']."</td>
                <td>
                    <div class='col-md-12'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <button id='".$row['id']."' class='btn btn-success approve'>Approve</button>
                            </div>
                            <div class='col-md-6'>
                                <button id='".$row['id']."' class='btn btn-danger reject'>Reject</button>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        ";
    }
}

$output .= "</table>";

echo $output; // This will send the generated HTML back to the AJAX request
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  // Approve button click event
  $(document).on("click", ".approve", function() {
    var id = $(this).attr("id");
    $.ajax({
      url: "<?php echo $_SERVER['PHP_SELF']; ?>",
      method: "POST",
      data: {id: id, action: "approve"},
      success: function(response) {
        alert(response); // Show success message
        // You may reload the table here if needed
        window.location.reload();
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText); // Log error message
      }
    });
  });

  // Reject button click event
  $(document).on("click", ".reject", function() {
    var id = $(this).attr("id");
    $.ajax({
      url: "<?php echo $_SERVER['PHP_SELF']; ?>",
      method: "POST",
      data: {id: id, action: "reject"},
      success: function(response) {
        alert(response); // Show success message
        // You may reload the table here if needed
        window.location.reload();
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText); // Log error message
      }
    });
  });
});
</script>
