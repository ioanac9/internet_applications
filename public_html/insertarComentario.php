<?php 

$idmovie = $_POST['idm'];
$iduser = $_POST['idu'];
$comentario = $_POST['comment'];
	
try { 
	$pdo = new PDO('mysql:host=localhost;dbname=ai33', 'ai33','ai2021');   
 
	}catch (PDOException $e) { 
 
   	echo 'Connection failed: ' . $e->getMessage(); 
 
	};

	

	if(isset($_POST['botonEnviar'])){

		$query = "INSERT INTO moviecomments(movie_id,user_id,comment) values 										
		('$idmovie', '$iduser', '$comentario')";
		$result = $pdo->query($query); 
		echo"<script>window.location= 'mostrarInfo.php?id=".$idmovie."'</script>";

	}

?>