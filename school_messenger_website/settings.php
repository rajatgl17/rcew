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
		$pwd=$_POST['pwd'];
		$pwd1=$_POST['pwd1'];
		$account= $_SESSION['username'];
		
		if(!($pwd==$pwd1))
			$msg='Entered passwords not same.';
		else{
			include_once('includes/connection.php');
			$pwd=md5($pwd);
			$query=$pdo->prepare('UPDATE teachers SET user_pwd=:pwd WHERE user_name=:name');
			$query->bindParam(':name',$account);
			$query->bindParam(':pwd',$pwd);
			$query->execute();
			$msg='Password updated';
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
				<li><a href="#">Change Password</a></li>
				<li><a href="addteacher.php">Add Teacher</a></li>
				<li><a href="addstudent.php">Add Student</a></li>
				<li><a href="parents.php">Parents's Feedback</a></li>
				<li><a href="delete.php">Delete Notice</a></li>	
				<li><a href="insert.php">New Notice</a></li>
			</ul>
		</div>
		</nav>
		<div>
			<form action="settings.php" method="post" class="bootstrap-frm">
			    <h1>Change password</h1>
			    <label>
			        <span>New Password</span>
			        <input id="name" type="text" name="pwd" placeholder="New password" />
			    </label>
			    
			    <label>
			        <span>Re-enter Password</span>
			        <input id="name" type="text" name="pwd1" placeholder="Re-enter password" />
			    </label>  
			     
			     <label>
			        <span>&nbsp;</span>
			        <input type="submit" class="button" value="Reset Password" name="post" />
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