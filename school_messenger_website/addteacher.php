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
		$user_name=$_POST['user_name'];
		$name=$_POST['name'];
		$password= md5($_POST['password']);
		
		if(!empty($user_name) && !empty($name) && !empty($password) ){
			include_once('includes/connection.php');

			$query=$pdo->prepare("SELECT * FROM teachers WHERE user_name=?");
			$query->bindValue(1,$user_name);
			$query->execute();
			$num=$query->rowCount();
			if($num==0){
				$query=$pdo->prepare('INSERT INTO teachers (user_name,name,user_pwd) VALUES (:user_name,:name,:user_pwd)');
				$query->bindParam(':user_name',$user_name);
				$query->bindParam(':name',$name);			
				$query->bindParam(':user_pwd',$password);
				$query->execute();
				$msg='Teacher added successfully.';
			} else {
				$msg='Username already exists.';
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
				<li><a href="#">Add Teacher</a></li>
				<li><a href="addstudent.php">Add Student</a></li>
				<li><a href="parents.php">Parents's Feedback</a></li>
				<li><a href="delete.php">Delete Notice</a></li>	
				<li><a href="insert.php">New Notice</a></li>
			</ul>
		</div>
		</nav>
		<div>
			<form action="addteacher.php" method="post" class="bootstrap-frm">
			    <h1>Add new teacher</h1>
			    <label>
			        <span>User name</span>
			        <input  type="text" name="user_name" placeholder="User name" />
			    </label>
			    
			    <label>
			        <span>Name</span>
			        <input  type="text" name="name" placeholder="name" />
			    </label> 

			    <label>
			        <span>Password</span>
			        <input  type="text" name="password" placeholder="Password" />
			    </label> 
			     
			     <label>
			        <span>&nbsp;</span>
			        <input type="submit" class="button" value="Add Teacher" name="post" />
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