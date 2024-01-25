<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Results</title>
</head>
<body style="background-image:url(images/hah.jpg); background-repeat:no-repeat;">
    <?php
    include("../include/header.php");
    include("../include/connect.php");


    if (isset($_GET['id'])) { 
        $id = (int)$_GET['id'];
        $query = "SELECT * FROM students WHERE id='$id'";
        $res = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($res);
		$nam=$row['name'];
		$i=$row['stud_id'];
    }
    ?>

    <div class="all_student fix">
       

        

        <div>
            <p style="text-align:center;color:#fff;background:purple;margin:0;padding:8px;">
                <?php echo "Name: " . $nam . " <br>Student ID: " .$i?>
            </p>
        </div>
			<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$subject = $_POST['umark'];
				$sql = "update result set marks='$mark' where stud_id='$id' and semester='$semester' and sub='$key' ";
				$result = $conn->query($sql);	
				//var_dump($res);
				if($result){
					echo "<h3 style='color:green;margin:0;padding:0;text-align:center'>Marks successfully updated!</h3>";
				}else{
					echo  "<p style='color:red;text-align:center'>Failed to update data</p>";
				}
			}
		
	
		?>

		
		<form action="" method="post">
		<table class="tab_one" style="text-align:center;">
			<tr>
				<th style="text-align:center;">Subject</th>
				<th style="text-align:center;">Marks</th>
				
			</tr>
			<?php 
			$i=0;
			
				$get_result = $user->show_marks($stid,$semester);
				
				while($rows = $get_result->fetch_assoc()){
				$i++;
		?>
			<tr>
				<td><?php echo $rows['sub'];?></td>
				<td><input type="text" name="umark[<?php echo $rows['sub'];?>]" value="<?php echo $rows['marks'];?>"/></td>
				
			</tr>
			<?php } ?>
			<tr><td colspan="2"><input type="submit" value="Update Result" /></td></tr>
		</table>
	</form>
		<div class="back fix">
				<p style="text-align:center"><a href="view_result.php?vr=<?php echo $stid?>&vn=<?php echo $name?>"><button class="editbtn">go to result page</button></a></p>
			</div>
</div>
<?php include "php/footerbottom.php";?>
<?php ob_end_flush() ; ?>