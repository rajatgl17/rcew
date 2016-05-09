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
		$title=$_POST['topic'];
		$content=$_POST['notice'];
		$branch=$_POST['branch'];
		$year=$_POST['year'];
		$rollno=$_POST['rollno'];
		$time=time();
		$time=$time+19800;
		$postedby=$_SESSION['name'];
		$postedbyusername=$_SESSION['username'];
		
		if(!empty($title) && !empty($content))
		{
			$query=$pdo->prepare('INSERT INTO notices (title,content,year,branch,rollno,postedby,postedbyusername,time) VALUES (:title,:content,:year,:branch,:rollno,:postedby,:postedbyusername,:time)');
			$query->bindParam(':title',$title);
			$query->bindParam(':content',$content);			
			$query->bindParam(':rollno',$rollno);
			$query->bindParam(':year',$year);
			$query->bindParam(':branch',$branch);
			$query->bindParam(':postedby',$postedby);
			$query->bindParam(':postedbyusername',$postedbyusername);
			$query->bindParam(':time',$time);
			$query->execute();
			$msg='Notice posted successfully.';
			
			/*
			$registatoin_ids = array();
			$query1;

			if($branh==0 && $rollno==0 && $year==0)
			{
				$query1=$pdo->prepare("SELECT * FROM gcm");
			}
			else if($rollno!=0)
			{
				$query1=$pdo->prepare("SELECT * FROM gcm WHERE rollno=:rollno AND branch=:branch AND year=:year");
				$query1->bindValue(':rollno',$rollno);
				$query1->bindValue(':branch',$branch);
				$query1->bindValue(':year',$year);
			}
			else if($branch!=0 && $year==0)
			{
				$query1=$pdo->prepare("SELECT * FROM gcm WHERE branch=:branch");
				$query1->bindValue(':branch',$branch);
			}
			else if($branch==0 && $year!=0)
			{
				$query1=$pdo->prepare("SELECT * FROM gcm WHERE year=:year");
				$query1->bindValue(':year',$year);
			}

			$query1->execute();
			$result=$query1->fetchAll();



			foreach($result as $row)
			{
				array_push($registatoin_ids, $row['reg_id']);
			}
			

			$url = 'https://android.googleapis.com/gcm/send';
			$message = array("Notice" => $_POST['topic']);
			$fields = array('registration_ids' => $registatoin_ids,
				'data' => $message,
				);

			$headers = array(
				'Authorization: key=AIzaSyAIeHxbnpkpfBL1V0Y6ISI6UoLgkUCLV2o ',
				'Content-Type: application/json'
				);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);   
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
			$result1 = curl_exec($ch);
			if ($result1 === FALSE) {
				die('Curl failed: ' . curl_error($ch));
			}
			curl_close($ch);
			//end
			*/
			
		}
		else $msg='All fields are necessary.';
	}
	?>
	<!doctype html>
	<html>
	<head>
		<title>Send Notice</title>
		<link rel="stylesheet" href="css/main.css">
		<script type="text/javascript" src="js/jquery.js"></script>
		<script src="//cdn.ckeditor.com/4.4.4/standard/ckeditor.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
				$('#branch').change(function(){
					getvalues();
				});
				$('#year').change(function(){
					getvalues();
				});
				
			});

			function getvalues(){
				var html = '<option value="0">All</option>';

				if($('#branch').val()!=0 && $('#year').val() !=0){
					var branch = $('#branch').val();
					var year = $('#year').val();

					$.ajax({
					  method: "POST",
					  url: "getrollno.php",
					  data: { branch: branch, year: year}
					})
					  .done(function(data) {
					  	if(JSON.parse(data).status!=1){
					  		$('#rollno').html($(html));
					  	} else {
					  	var rollno = JSON.parse(data).data[0];
					  	
					  	for(var i=0; i<rollno.length; i++){
					  		html = html + '<option value="'+rollno[i]+'">'+rollno[i]+'</option>';
					  	}
					  	$('#rollno').html($(html));
					  }
					  });

				}else{
					$('#rollno').html($(html));
				}
			}
		</script>
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
					<li><a href="delete.php">Delete Notice</a></li>	
					<li><a href="#">New Notice</a></li>			

				</ul>
			</div>
		</nav>
		<div>
			
			<form action="insert.php" method="post" class="bootstrap-frm">
				<h1>Add new notice  </h1>

				<label>
					<span>Topic :</span>
					<input id="name" type="text" name="topic" placeholder="Topic" />
				</label>

				<label>
					<textarea id="notice" name="notice" rows="50"></textarea>
					<script>
					CKEDITOR.replace( 'notice' );
					</script>
				</label>
				<label>
					<span>Year :</span><select name="year" id="year">
					<option value="0">All</option>
					<option value="1">I Year</option>
					<option value="2">II Year</option>
					<option value="3">III Year</option>
					<option value="4">IV Year</option>
				</select>
			</label>
			<label>
				<span>Branch :</span><select name="branch" id="branch">
				<option value="0">All</option>
				<option value="1">Computer Science</option>
				<option value="2">Information Technology</option>
				<option value="3">Electronics and Communication</option>
				<option value="4">Mechanical</option>
				<option value="5">Electrical</option>
				<option value="6">Civil</option>
			</select>
		</label>  
		<label>
			<span>Roll no.: </span><select name="rollno" id="rollno">
			<option value="0">All</option>
		</select>
	</label>  
	<label>
		<span>&nbsp;</span>
		<input type="submit" class="button" value="SEND" name="post" />
	</label>   
	<p><?php echo $msg; ?> </p>
</form>

</div>
</body>
</html>

<?php
}
else
	header('Location:index.php');
?>