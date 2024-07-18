<?php
include("../include/connect.php");
$id=$_POST['id'];
$query="UPDATE students SET status='Active' WHERE id='$id'";
mysqli_query($conn,$query);
?>