<html>
<link rel="stylesheet" href="css/estilo.css">
<head>
<title>Videorec</title>
</head>
<body>
<h1><a href = "principal.php">Videorec</a></h1>
<h1 align='center'>Peliculas recomendadas: </h1>

<?php
	try {
		$pdo = new PDO('mysql:host=localhost;dbname=ai33', 'ai33','ai2021'); 
	}catch (PDOException $e) {
		echo 'Connection failed: '. $e->getMessage();
	};

		
		echo "<table border='1' align='center' style='width:60%'>";
       		echo "<tr>";
        	echo "<th width ='150' heigth='211'>Foto</th>";
       		echo "<th>Título</th>";
		echo "<th>Puntuación</th>";
        	echo "</tr>";
		$queryRec= "SELECT * FROM recs WHERE recs.user_id='".$_COOKIE["sesion"]."' ORDER BY recs.rec_score DESC";
		$resultRec = $pdo->query($queryRec);

			for ($i = 0; $i < 10; $i++) {
				$ll=$resultRec->fetch(PDO::FETCH_ASSOC);
				$queryMov= "SELECT id,title,url_pic FROM movie WHERE movie.id=".$ll['movie_id'];
				$resultMov = $pdo->query($queryMov);
				$lll=$resultMov->fetch(PDO::FETCH_ASSOC);
				echo "<tr>";
               			echo "<td><img width ='150' heigth='211' src= 'images/".$lll["url_pic"]."'></td>";
				echo "<td>".$lll["title"]."</td>";
				echo "<td>".$ll["rec_score"]."</td>";
				echo "</tr>";	
			}
 
				

      ?>
</html>