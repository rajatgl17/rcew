<?php
	if(isset($_POST['year']) && isset($_POST['branch']))
	{
		$year=$_POST['year'];
		$branch=$_POST['branch'];
		
		include_once('includes/connection.php');
		$query=$pdo->prepare('SELECT rollno FROM parents WHERE year=:year AND branch=:branch');
		$query->bindValue(':year',$year);
		$query->bindValue(':branch',$branch);
		$query->execute();
		$result=$query->fetchAll(PDO::FETCH_NUM);
		$num=$query->rowCount();
		
		if($num==1){
			//header('Content-type: application/json');
    		echo json_encode(array('status' => 1, 'msg' => '', 'data' => $result));
		} else {
			//header('Content-type: application/json');
    		echo json_encode(array('status' => 0, 'msg' => 'Invalid roll number or password.', 'data' => array()));
		}
	} else {
		//header('Content-type: application/json');
    	echo json_encode(array('status' => 0, 'msg' => 'All fields are mandatoty', 'data' => array()));
	}
?>