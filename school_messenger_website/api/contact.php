<?php
	if(isset($_GET['rollno']) && isset($_GET['year']) && isset($_GET['branch']) && isset($_GET['subject']) && isset($_GET['message']))
	{
		$rollno=$_GET['rollno'];
		$year=$_GET['year'];
		$branch=$_GET['branch'];
		$subject=$_GET['subject'];
		$message=$_GET['message'];

		include_once('../includes/connection.php');
		
		$query1=$pdo->prepare('INSERT INTO contact (year,branch,rollno,subject,message) VALUES (:year,:branch,:rollno,:subject,:message)');
				
				$query1->bindParam(':year',$year);
				$query1->bindParam(':branch',$branch);	
				$query1->bindParam(':rollno',$rollno);		
				$query1->bindParam(':subject',$subject);
				$query1->bindParam(':message',$message);
				$query1->execute();
		
    		echo json_encode(array('status' => 1, 'msg' => '', 'data' => array()));
		
	} else {
    		echo json_encode(array('status' => 0, 'msg' => 'All fields are mandatoty', 'data' => array()));
	}
?>