<?php
	try{
		$pdo=new PDO('mysql:host=localhost;dbname=raja7466_sm','raja7466_sm','raja7466_sm');	
	} catch(PDOException $e) {
		exit('Database connection error.');
	}
?>