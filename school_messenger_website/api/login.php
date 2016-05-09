<?php
	//if(isset($_GET['rollno']) && isset($_GET['password']) && isset($_GET['year'] && isset($_GET['branch']))
	//{
		$rollno=$_GET['rollno'];
		$year=$_GET['year'];
		$branch=$_GET['branch'];
		$password=md5($_GET['password']);

		include_once('../includes/connection.php');
		$query=$pdo->prepare('SELECT * FROM parents WHERE rollno=:rollno AND password=:password AND year=:year AND branch=:branch');
		$query->bindValue(':rollno',$rollno);
		$query->bindValue(':password',$password);
		$query->bindValue(':year',$year);
		$query->bindValue(':branch',$branch);
		$query->execute();
		$result=$query->fetchAll();
		$num=$query->rowCount();
		
		if($num==1){
			//header('Content-type: application/json');
    		echo json_encode(array('status' => 1, 'msg' => '', 'data' => $result));
		} else {
			//header('Content-type: application/json');
    		echo json_encode(array('status' => 0, 'msg' => 'Invalid roll number or password.', 'data' => array()));
		}
	/*} else {
		//header('Content-type: application/json');
    	echo json_encode(array('status' => 0, 'msg' => 'All fields are mandatoty', 'data' => array()));
	}*/
?>