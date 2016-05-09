<?php
if(isset($_POST['submit']))
{	
	include_once('includes/connection.php');
	$un=$_POST['username'];
	$pwd=$_POST['password'];
	$pwd=md5($pwd);

	
	$query=$pdo->prepare("SELECT * FROM teachers WHERE user_name=? AND user_pwd=?");
	$query->bindValue(1,$un);
	$query->bindValue(2,$pwd);
	$query->execute();
	$num=$query->rowCount();
	$result=$query->fetch();
	
	
	if($num==1)
	{
		session_start();
		$_SESSION['username']=$result['user_name'];;
		$_SESSION['name']=$result['name'];;
		header('Location:insert.php');
	}
	
	else
	{
		
		$msg='Incorrect username or password';
		
	}
}
?>

<!doctype html>
<html>
<head>
	<title>RCEW, Jaipur</title>
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
	
	<div id="header">
		<center>
			<span class="t1">RCEW, Jaipur</span><br>
			</center
		</div>
		
		<div class="login">
			<form action="index.php" method="post">
				<input type="text" placeholder="Username" name="username" required>  
				<input type="password" placeholder="Password" name="password" required>  
				<input type="submit" value="Sign In" name="submit">
				<center><p class="forgot">
					<?php
					if(isset($msg)) echo $msg;
					?>
				</p></center>
			</form>
		</div>
		
	</body>
	</html>
	<?php
