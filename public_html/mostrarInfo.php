<html>
<title>Videorec</title>

<link rel="stylesheet" href="css/estilo.css">

<div>
<h1><a  href = 'principal.php'>Videorec</a></h1>
</div>
<h1 align='center'>Información de la película</h1>

<?php
    	try {
		$pdo = new PDO('mysql:host=localhost;dbname=ai33', 'ai33','ai2021'); 
	}catch (PDOException $e) {
		 echo 'Connection failed: ' . $e->getMessage();
	};
        
        $query = "SELECT * FROM movie WHERE movie.id=".$_GET['id'];
	$result = $pdo->query($query);
	echo"<br>";
	echo "<table id='tablax' border='1' align='center' style='width:100%'>";
        echo "<tr>";
        echo "<th width ='150' heigth='211'>Cartel</th>";
        echo "<th>Título</th>";
	echo "<th>Género</th>";
        echo "<th>Descripción</th>";
        echo "<th>Fecha de estreno</th>";
        echo "</tr>";
	
       
			$l=$result->fetch(PDO::FETCH_ASSOC);
				echo "<tr>";
               			echo "<td><img width ='150' heigth='211' src= 'images/".$l["url_pic"]."'></td>";
				echo "<td>".$l["title"]."</td>";
				echo "<td>";				
       					$queryGen = "SELECT genre FROM moviegenre WHERE moviegenre.movie_id=".$_GET['id'];
					$r = $pdo->query($queryGen);
					while($k=$r->fetch(PDO::FETCH_ASSOC)){
						$queryGen2 = "SELECT name FROM genre WHERE genre.id=".$k['genre'];
						$res = $pdo->query($queryGen2);
						$a=$res->fetch(PDO::FETCH_ASSOC);
						echo $a['name'];
						echo "<br>";
					}	
				echo "</td>";
				echo "<td>".$l["desc"]."</td>";
                		echo "<td>".$l["date"]."</td>";
				echo "</tr>";
				echo "</table>";
				

	
	echo "<br>";


	if (isset($_COOKIE['sesion'])) {

	echo "<br>";
	
	echo "Puntúa esta película: ";

	echo "<br>";

	$idmov =$_GET['id'];
	$queryPunt = "SELECT * FROM user_score WHERE user_score.id_user=".$_COOKIE['sesion']." AND user_score.id_movie=$idmov";
	$resul = $pdo->query($queryPunt);
	$h=$resul->fetch(PDO::FETCH_ASSOC);
	if ($h != 0)
	{

		
	echo 	"<form action = 'actualizarPuntuacion.php' method='GET'>";
	}
	else 
	{
	echo 	"<form action = 'añadirPuntuacion.php' method='GET'>";
	}

	
	echo "<input type='hidden' name='id_u' value=".$_COOKIE['sesion'].">";
	echo "<input type='hidden' name='id_m' value=".$_GET['id'].">";
	
	echo   "<input id='radio1' type='radio' name='punt' value='1'>";
	echo    "<label for='radio1'>1</label>";
	echo   "<input id='radio2' type='radio' name='punt' value='2'>";
	echo    "<label for='radio2'>2</label>";
	echo   "<input id='radio3' type='radio' name='punt' value='3'>";
	echo    "<label for='radio3'>3</label>";
	echo   "<input id='radio4' type='radio' name='punt' value='4'>";
	echo    "<label for='radio4'>4</label>";
	echo   "<input id='radio5' type='radio' name='punt' value='5'>";
	echo    "<label for='radio5'>5</label>";
	echo	"  ";
	echo	"<input type='submit' value='Puntuar' name='BotonPuntuar' style='background-color:lightyellow'>";
	echo	"</form>";



	

	$idmovie =$_GET['id'];
	$queryPunt = "SELECT * FROM user_score WHERE user_score.id_user=".$_COOKIE['sesion']." AND user_score.id_movie=$idmovie";
	$resu = $pdo->query($queryPunt);
	$t=$resu->fetch(PDO::FETCH_ASSOC);
	if ($t != 0)
	{
	echo "<p>Tu puntuación para esta película es: ".$t["score"]." </p>";
	}
	
	}


	$queryC = "SELECT * FROM moviecomments WHERE moviecomments.movie_id=".$_GET['id'];
	$resultC = $pdo->query($queryC);
	echo "<table border='1' style='width:60%'>";
        echo "<tr>";
        echo "<th>Usuario</th>";
        echo "<th>Comentario</th>";
	echo "</tr>";
		
		while($a=$resultC->fetch(PDO::FETCH_ASSOC)){
		$queryU = "SELECT * from users WHERE users.id =".$a['user_id'];
		$resultU = $pdo->query($queryU);
		$b=$resultU->fetch(PDO::FETCH_ASSOC);
		echo "<tr>";
        	echo "<td>".$b['name']."</td>";
		echo "<td>".$a['comment']."</td>";
		echo "</tr>";
		}

	echo "</table>";	


if (isset($_COOKIE['sesion'])) {
	echo '<form action="insertarComentario.php" method="POST">';
	echo "<input type='hidden' name='idu' value=".$_COOKIE['sesion'].">";
	echo "<input type='hidden' name='idm' value=".$_GET['id'].">";
	echo "<br>";
	echo "Escribe un comentario:<br>";
	echo "<input name='comment' type='text' style='width:20%'>";
	echo "<input type='submit' value='Comentar' name='botonEnviar' style='background-color:lightyellow'>";
}

?>
</html>