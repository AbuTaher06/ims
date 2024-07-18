<?php
include("../include/connect.php");
$id=$_POST['id'];
$query="UPDATE improvement_requested SET status='Approved' WHERE id='$id'";

mysqli_query($conn,$query);
?>