<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start();

if (!isset($_SESSION['dept'])) {
    header("Location: ../deptlogin.php");
    ob_end_flush();
    exit();
}

include("../include/connect.php");

// Check if this is an AJAX request
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['action'])) {
    $studentId = $_POST['id'];
    $action = $_POST['action'];
    
    // Perform action based on the button clicked
    if ($action === 'approve') {
        $updateSql = "UPDATE students SET status='Approved' WHERE id='$studentId'";
        if (mysqli_query($conn, $updateSql)) {
            echo "Student approved successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } elseif ($action === 'reject') {
        $updateSql = "UPDATE students SET status='Rejected' WHERE id='$studentId'";
        if (mysqli_query($conn, $updateSql)) {
            echo "Student rejected successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid action";
    }
    
    // Since it's an AJAX request, don't output any HTML or other content
    exit();
}

// For regular page loading, include your header and other HTML
$pageTitle = "Registration | Request";
include("header.php");
include("sidebar.php");
?>


<main id="main" class="main">
    <h2 class="mb-0 text-center bg-info">
        <i class="fas fa-exclamation-circle"></i> Pending  Request for Registration
    </h2>
    
    <div id="messageBox" style="display: none; margin: 15px 0;"></div>

<?php
$dept = $_SESSION['dept'];

$dept_sql="SELECT dept_name FROM department WHERE username='$dept'";
$dept_res=mysqli_query($conn,$dept_sql);
$dept_row=mysqli_fetch_assoc($dept_res);
$dept_name=$dept_row['dept_name'];

$sql = "SELECT * FROM students WHERE status='Pending' AND department='$dept_name' ORDER BY data_reg ASC";
$res = mysqli_query($conn, $sql);

$output = "
<table class='table table-bordered'>
    <tr> 
        <th>Serial No</th>
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

if (mysqli_num_rows($res) == 0) {
    $output .= "
        <tr>
            <td colspan='9' class='text-center'>No Pending Request</td>
        </tr>
    ";
} else {
    $i = 0;
    while ($row = mysqli_fetch_array($res)) {
        $i++;
        $output .= "
        <tr>
            <td>".$i."</td>
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
                            <button class='btn btn-success approve' data-id='".$row['id']."' style='display: flex; align-items: center;'>
                                <i class='fas fa-check' style='margin-right: 5px;'></i> Approve
                            </button>
                        </div>
                        <div class='col-md-6'>
                            <button class='btn btn-danger reject' data-id='".$row['id']."' style='display: flex; align-items: center;'>
                                <i class='fas fa-times' style='margin-right: 5px;'></i> Reject
                            </button>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        ";
    }
}

$output .= "</table>";
echo $output;
?>

</main>
<style>
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

<script>
$(document).ready(function() {
    // Approve button click event
    $(document).on("click", ".approve", function() {
        var id = $(this).data("id");
        var button = $(this);

        var confirmed = confirm("Are you sure you want to approve this request?");
        if (confirmed) {
            button.prop("disabled", true);
            $.ajax({
                url: "<?php echo $_SERVER['PHP_SELF']; ?>",
                method: "POST",
                data: {id: id, action: "approve"},
                success: function(response) {
                    $("#messageBox").text("Student approved successfully!").removeClass("text-danger").addClass("text-success").show();
                    setTimeout(function() {
                        window.location.reload(); // Reload page after a short delay
                    }, 2000);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    button.prop("disabled", false);
                    $("#messageBox").text("Error approving student.").removeClass("text-success").addClass("text-danger").show();
                }
            });
        }
    });

    // Reject button click event
    $(document).on("click", ".reject", function() {
        var id = $(this).data("id");
        var button = $(this);

        var confirmed = confirm("Are you sure you want to reject this request?");
        if (confirmed) {
            button.prop("disabled", true);
            $.ajax({
                url: "<?php echo $_SERVER['PHP_SELF']; ?>",
                method: "POST",
                data: {id: id, action: "reject"},
                success: function(response) {
                    $("#messageBox").text("Student rejected successfully!").removeClass("text-danger").addClass("text-success").show();
                    setTimeout(function() {
                        window.location.reload(); // Reload page after a short delay
                    }, 2000);
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    button.prop("disabled", false);
                    $("#messageBox").text("Error rejecting student.").removeClass("text-success").addClass("text-danger").show();
                }
            });
        }
    });
});
</script>


<?php 
include('footer.php');
?>
