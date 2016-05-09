<?php
session_start();
if(isset($_SESSION['username']))
{	
	$msg='';
	?>

	<?php
	if(isset($_POST['post']))
	{
		include_once('includes/connection.php');
		$rollno=$_POST['rollno'];
		$name=$_POST['name'];
		$parentname= $_POST['parentname'];
		$year=$_POST['year'];
		$branch=$_POST['branch'];
		$rollno=$_POST['rollno'];
		$password= md5($_POST['password']);
		
		if(!empty($rollno) && !empty($name) && !empty($parentname) && !empty($password) ){
			include_once('includes/connection.php');

			$query=$pdo->prepare("SELECT * FROM parents WHERE rollno=? AND year=? AND branch=?");
			$query->bindValue(1,$rollno);
			$query->bindValue(2,$year);
			$query->bindValue(3,$branch);
			$query->execute();
			$num=$query->rowCount();
			if($num==0){
				$query1=$pdo->prepare('INSERT INTO parents (rollno,name,parentname,password,year,branch) VALUES (:rollno,:name,:parentname,:password,:year,:branch)');
				$query1->bindParam(':rollno',$rollno);
				$query1->bindParam(':name',$name);			
				$query1->bindParam(':parentname',$parentname);
				$query1->bindParam(':password',$password);
				$query1->bindParam(':year',$year);
				$query1->bindParam(':branch',$branch);
				$query1->execute();
				$msg='Student added successfully.';
			} else {
				$msg='Student rollno already exists.';
			}
		}
		else{
			$msg='All fields are mandatory';
		}
	}
	?>		
	<!doctype html>
	<html>
	<head>
		<title>Settings</title>
		<link rel="stylesheet" href="css/main.css">
	</head>
	<body>
		<div id="oheader">
			<div id="header">
				<center>
					<span class="t1">RCEW, Jaipur</span><br>
				</center>
			</div>
		</div>
		<nav>
			<div id="nav">

				<ul>
					<li><a href="logout.php">Log Out</a></li>	
					<li><a href="settings.php">Change Password</a></li>
					<li><a href="addteacher.php">Add Teacher</a></li>
					<li><a href="#">Add Student</a></li>
					<li><a href="parents.php">Parents's Feedback</a></li>
					<li><a href="delete.php">Delete Notice</a></li>	
					<li><a href="insert.php">New Notice</a></li>
				</ul>
			</div>
		</nav>
		<div>
			<form action="addstudent.php" method="post" class="bootstrap-frm">
				<h1>Add new student</h1>
				<label>
					<span>Roll No</span>
					<input  type="text" name="rollno" placeholder="Roll No." />
				</label>

				<label>
					<span>Student Name</span>
					<input  type="text" name="name" placeholder="name" />
				</label> 

				<label>
					<span>Parent Name</span>
					<input  type="text" name="parentname" placeholder="parentname" />
				</label>

				<label>
					<span>Password</span>
					<input  type="text" name="password" placeholder="Password" />
				</label>

				<label>
					<span>Year :</span><select name="year">
					<option value="1">I Year</option>
					<option value="2">II Year</option>
					<option value="3">III Year</option>
					<option value="4">IV Year</option>
				</select>
			</label>
			<label>
				<span>Branch :</span><select name="branch">
				<option value="1">Computer Science</option>
				<option value="2">Information Technology</option>
				<option value="3">Electronics and Communication</option>
				<option value="4">Mechanical</option>
				<option value="5">Electrical</option>
				<option value="6">Civil</option>
			</select>
		</label>  


		<label>
			<span>&nbsp;</span>
			<input type="submit" class="button" value="Add Student" name="post" />
		</label>   
		<?php echo $msg; ?> 
	</form>

</div>
</body>
</html>

<?php
}
else
	header('Location:index.php');
?>