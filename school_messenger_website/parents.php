<?php
	session_start();
	if(isset($_SESSION['username']))
	{	
        include_once('includes/connection.php');
        $query=$pdo->prepare("SELECT * FROM contact");
        $query->bindValue(1,$_SESSION['username']);
        $query->execute();
        $result=$query->fetchAll();
		
?>		
<!doctype html>
<html>
	<head>
		<title>Delete</title>
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/delete.css">
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
				<li><a href="addstudent.php">Add Student</a></li>
				<li><a href="#">Parents's Feedback</a></li>
				<li><a href="delete.php">Delete Notice</a></li>	
				<li><a href="insert.php">New Notice</a></li>
			</ul>
		</div>
		</nav>
		<div id="del">
		<table id="table1">
			<tr>
				<th>Subject</th>
				<th>Year</th>
				<th>Branch</th>
				<th>Roll No</th>
			</tr>
		<?php foreach($result as $notice) { ?>
			<tr>
				<td> <a href="parentsnotice.php?id=<?php echo $notice['id']; ?>" target="_blank"><?php echo $notice['subject']; ?></a> </td>
				<td>
				 <?php switch($notice['year']){
				 	case 1: echo 'I year'; break;
				 	case 2: echo 'II year'; break;
				 	case 3: echo 'III year'; break;
				 	case 4: echo 'IV year'; break;
				 	} ?> 
				</td>
				<td>
				 <?php switch($notice['branch']){
				 	case 1: echo 'Computer Science'; break;
				 	case 2: echo 'Information Technoloy'; break;
				 	case 3: echo 'Electronics and Communication'; break;
				 	case 4: echo 'Electrical'; break;
				 	case 5: echo 'Mechanical'; break;
				 	case 6: echo 'Civil'; break;
				 	} ?> 
				</td>
				<td> <?php echo $notice['rollno']; ?> </td>
			</tr>
		<?php } ?>
		</table>	
		</div>
	</body>
</html>

<?php
	}
	else
		header('Location:index.php');
?>