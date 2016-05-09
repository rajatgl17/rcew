<?php
	session_start();
	if(isset($_SESSION['username']))
	{
	 	if(isset($_GET['id']))
	 	{
	 		$id=$_GET['id'];
	 		include_once('includes/connection.php');
	 		$query=$pdo->prepare('DELETE FROM notices WHERE id=:id');
	 		$query->bindParam(':id',$id);
	 		$query->execute();
	 		header('Location:delete.php');
	 	}
	 	else
	 		header('Location:delete.php');
	
	}
	else
		header('Location:index.php');
?>	
