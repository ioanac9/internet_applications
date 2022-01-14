<?php 

$idmovie = $_GET['id_m'];
$iduser = $_GET['id_u'];
$score = $_GET['punt'];
	
try { 
	$pdo = new PDO('mysql:host=localhost;dbname=ai33', 'ai33','ai2021');  
 
	}catch (PDOException $e) { 
 
   	echo 'Connection failed: ' . $e->getMessage(); 
 
	};

	

	if(isset($_GET['BotonPuntuar'])){

		$query = "UPDATE user_score SET user_score.id_user = '$iduser', user_score.id_movie = '$idmovie',
			user_score.score = '$score' WHERE user_score.id_user=".$_COOKIE['sesion']." AND user_score.id_movie=$idmovie";									
		$result = $pdo->query($query); 
		echo "<script> alert('Puntuación modificada')</script>";
		echo"<script>window.location= 'mostrarInfo.php?id=".$idmovie."'</script>";

	}

?>