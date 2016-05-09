<?php
	session_start();
	if(isset($_SESSION['username']))
	{	
        include_once('includes/connection.php');
        $query=$pdo->prepare("SELECT * FROM notices WHERE postedbyusername=?");
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
				<li><a href="parents.php">Parents's Feedback</a></li>
				<li><a href="#">Delete Notice</a></li>	
				<li><a href="insert.php">New Notice</a></li>
			</ul>
		</div>
		</nav>
		<div id="del">
		<table id="table1">
			<tr>
				<th>Notie Title</th>
				<th>Posted By</th>
				<th>Time</th>
				<th>Delete</th>
			</tr>
		<?php foreach($result as $notice) { ?>
			<tr>
				<td> <a href="notice.php?id=<?php echo $notice['id']; ?>" target="_blank"><?php echo $notice['title']; ?></a> </td>
				<td> <?php echo $notice['postedby']; ?> </td>
				<td> <?php echo date("d-m-Y H:i",$notice['time']); ?> </td>
				<td> <a href="del.php?id=<?php echo $notice['id']; ?>">Delete</a> </td>
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