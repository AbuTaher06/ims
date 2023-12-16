<?php
include("../include/connect.php");
$id=$_POST['id'];
$query="UPDATE doctors SET status='Rejected' WHERE id='$id'";
mysqli_query($conn,$query);
?>