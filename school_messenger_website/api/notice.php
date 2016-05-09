<?php
	include_once('../includes/connection.php');
	
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$query=$pdo->prepare("SELECT * FROM notices WHERE id=?");
		$query->bindValue(1,$id);
		$query->execute();
		$result=$query->fetch();
?>

<html>
	<head>
	<!--meta name="viewport" content="width=device-width" /-->
	<style rel="stylesheet">
body{
	background-color: rgb(255, 248, 213);
	padding:5px;
}
h2{
	color: #555555;
	text-align: center;
	border-bottom: 1px solid #999999;
}

	</style>
	</head>
	<body>
		<h2><?php echo $result['title']; ?></h2>
		<t><?php echo $result['content']; ?></t>
		<p>Posted by: <?php echo $result['postedby']; ?></p>
	</body>
</html>

<?php	
	} else{
		exit();
	}
?>