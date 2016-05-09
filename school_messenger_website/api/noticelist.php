<?php
	$result;
	if(isset($_GET['rollno']))
	{
		$rollno=$_GET['rollno'];
		$year=$_GET['year'];
		$branch=$_GET['branch'];

		include_once('../includes/connection.php');
		$query=$pdo->prepare('SELECT title,id FROM notices WHERE (rollno=:rollno AND year=:year AND branch=:branch) OR (year=0 AND branch=0) OR (year=0 AND branch=:branch) OR (branch=0 AND year=:year)');
		$query->bindValue(':rollno',$rollno);
		$query->bindValue(':year',$year);
		$query->bindValue(':branch',$branch);

		$query->execute();
		
		$result=$query->fetchAll();
		
    		//echo json_encode(array('status' => 1, 'msg' => '', 'data' => $result));
		
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css">
<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
</head>
<body>

<div data-role="page" id="pageone">
  <div data-role="main" class="ui-content">
    <ul data-role="listview">
    <?php foreach($result as $key=>$value)
      echo '<li><a href="http://rajatgoel.in/school_messenger/api/notice.php?id='.$value['id'].'">'.$value['title'].'</a></li>';
    ?>
    </ul>
  </div>
</div> 

</body>
</html>
<?php
	}
?>