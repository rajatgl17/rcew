<?php
	try{
		$pdo=new PDO('mysql:host=localhost;dbname=raja7466_sm','root','');	
	} catch(PDOException $e) {
		exit('Database connection error.');
	}
?>
