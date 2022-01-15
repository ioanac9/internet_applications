<?php 
try { 
	$pdo = new PDO('mysql:host=localhost;dbname=ai33', 'ai33','ai2021');  
 
	}catch (PDOException $e) { 
 
   	echo 'Connection failed: ' . $e->getMessage(); 
 
	}; 
	$query = "DELETE FROM users WHERE id = ".$_COOKIE['session'];
	$result=$pdo->query($query);
	$query1 = "DELETE FROM moviecomments WHERE user_id = ".$_COOKIE['session'];
	$result1=$pdo->query($query1);

	setcookie('session',1,time()-3600);
	echo "<script> window.location = 'main.php'</script>";
?>	





