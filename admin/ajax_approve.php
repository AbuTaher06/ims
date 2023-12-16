<?php
include("../include/connect.php");
$id=$_POST['id'];
$query="UPDATE doctors SET status='Aproved' WHERE id='$id'";
mysqli_query($conn,$query);
?>