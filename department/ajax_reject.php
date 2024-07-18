<?php
include("../include/connect.php");
$id=$_POST['id'];
$query="UPDATE students SET status='inactive' WHERE id='$id'";
mysqli_query($conn,$query);
?>