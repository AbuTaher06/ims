<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>View Results</title>
   <style>
    table.tab_two{
	width:100%;
	
}
table.tab_two tr {
	border:1px solid #ddd;
	
}
table.tab_two td{
	text-align:center;
	padding:20px;
}
table.tab_two td a{
	padding: 5px;
	color: #00C2A9;
}
table.tab_two tr:hover{
	background-color:#f5f5f5;
	
}
   </style>
    </head>
    <body style="background-image:url(images/hah.jpg); background-repeat:no-repeat;">
        <?php
            include("../include/header.php");
            include("../include/connect.php");
        
// if (!isset($_SESSION['student'])) {
//     header('Location: index.php');
//     exit();
//   }
  

                            if(isset($_GET['id'])){
                                $id = (int)$_GET['id'];

                               
                                $query="SELECT * FROM students WHERE id='$id'";
                                $res=mysqli_query($conn,$query);
                                $row=mysqli_fetch_array($res);
                            }
                            ?>
<div class="all_student fix">

		<?php
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$subject = $_POST['subject'];
				$cred = $_POST['cred'];
				$semester = $_POST['semester'];
				$marks = $_POST['marks'];
                $id = $row['stud_id'];
                $name=$row['name'];
				$res =mysqli_query($conn,"insert into result(st_id,name,marks,sub,credit_hour,semester) values('$id','$name','$marks','$subject','$cred','$semester')");
				if ($res) {
                    echo "<div class='result-message alert alert-success' role='alert'>Marks successfully inserted!</div>";
                } else {
                    echo "<div class='result-message alert alert-danger' role='alert'>Failed to insert data: " . mysqli_error($conn) . "</div>";
                }
			}
		
		//SELECT avg(marks) as sgpa from result where st_id=10 and semester="1sr"
		?>
	<div>
	<p style="text-align:center;color:#fff;background:purple;margin:0;padding:8px;"><?php echo "Name: ".$row['name']."<br>Student ID: " . $row['stud_id']; ?></p>
	</div>	
	<div style="width:40%;margin:50px auto">
		
		<table class="tab_two" style="text-align:center;">
			<form action="" method="post">
				<table class="table table-bordered rounded table-info">
					<tr>
						<td>Select subject: </td>
						<td>
						<select name="subject" id="">
							<option value="DBMS">Database management</option>
							<option value="DBMS Lab">DBMS Lab</option>
							<option value="Mathematics">Mathematics</option>
							<option value="Programming">Programming</option>
							<option value="Programming Lab">Programming Lab</option>
							<option value="English">English</option>
							<option value="Physics">Physics</option>
							<option value="Chemistry">Chemistry</option>
							<option value="Psychology">Psychology</option>
							
						</select>
						</td>
					</tr>
					<tr>
						<td>Credit Hour's: </td>
						<td><input type="text" name="cred" placeholder="Enter Credit Hour" required /></td>
					</tr>
					<tr>
						<td>Select Semester: </td>
						<td>
						<select name="semester" id="">
							<option value="1st">1st semester</option>
							<option value="2nd">2nd semester</option>
							<option value="3rd">3rd semester</option>
							<option value="4th">4th semester</option>
							<option value="5th">5th semester</option>
							<option value="6th">6th semester</option>
							<option value="7th">7th semester</option>
							<option value="8th">8th semester</option>
							
						</select>
						</td>
					</tr>
					<tr>
						<td>Input marks: </td>
						<td><input type="text" name="marks" placeholder="Enter marks" required /></td>
					</tr>
					<tr>
						<td><input type="submit" name="sub" value="Add marks" class="btn btn-success" /></td>
						<td><input type="reset" class="btn btn-success" /></td>
					</tr>
				</table>
				
			</form>
		</table>
		
	</div>
		<div class="back fix">
				<p style="text-align:center"><a href="student.php"><button class="btn btn-secondary font-weight-bolder">Back to list</button></a></p>
			</div>
</div>
<?php 
        include("../footer.php");
        ?>
<?php ob_end_flush() ; ?>