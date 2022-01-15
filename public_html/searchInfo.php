<html>
<title>TVTime</title>

<link rel="stylesheet" href="styling/styles.css">
<div>
<h1><a  href = 'principal.php'>TVTime</a></h1>
</div>

<?php
    	try {
		$pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
	}catch (PDOException $e) {
		 echo 'Connection failed: ' . $e->getMessage();
	};

        $query = "SELECT * FROM movie WHERE movie.id=".$_GET['id'];
	$result = $pdo->query($query);


			$l=$result->fetch(PDO::FETCH_ASSOC);
				echo "<div class=movie-container-single>";
				echo "<div class=movie-info>";
               			echo "<img class='movie-info-single' src= 'images/".$l["url_pic"]."'/>";
				echo "<div class='text-movie-container'>
				<div><h1>".$l["title"]."</h1></div>";
				echo "<div> <span class='desc'> Genre: </span>";
       					$queryGen = "SELECT genre FROM moviegenre WHERE moviegenre.movie_id=".$_GET['id'];
					$r = $pdo->query($queryGen);
					while($k=$r->fetch(PDO::FETCH_ASSOC)){
						$queryGen2 = "SELECT name FROM genre WHERE genre.id=".$k['genre'];
						$res = $pdo->query($queryGen2);
						$a=$res->fetch(PDO::FETCH_ASSOC);
						echo $a['name'];
					}
					echo "</div>";
				echo "<div> <span class='desc'> Description: </span> ".$l["desc"]."</div>";
                		echo "<div> <span class='desc'> Release date: </span>".$l["date"]."</div>";
					$queryC = "SELECT * FROM moviecomments WHERE moviecomments.movie_id=".$_GET['id'];
                	$resultC = $pdo->query($queryC);

                		echo "<div class='reviews'>";
                		echo "<div style='display:flex; align-items:center'><h2>Reviews</h2> <img style='height:30px' src='img/star.png'/></div>";
                		echo "<div class='comments-section'>";

                		while($a=$resultC->fetch(PDO::FETCH_ASSOC)){
                		$queryU = "SELECT * from users WHERE users.id =".$a['user_id'];
                		$resultU = $pdo->query($queryU);
                		$b=$resultU->fetch(PDO::FETCH_ASSOC);
                		echo "<div class='single-review'>";
                        	echo "<span class='desc'>".$b['name'].": </span>";
                		echo "<span>".$a['comment']."</span>";
                		echo "</div>";

                		}
                						echo "</div>";

                	echo "</div>";

				echo "</div>";

								echo "</div>";

				echo "</div>";
				echo "</div>";


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


	echo 	"<form action = 'updateRating.php' method='GET'>";
	}
	else
	{
	echo 	"<form action = 'addRating.php' method='GET'>";
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
	echo	"<input type='submit' value='Puntuar' name='ReviewBtn' style='background-color:lightyellow'>";
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


if (isset($_COOKIE['sesion'])) {
	echo '<form action="addComment.php" method="POST">';
	echo "<input type='hidden' name='idu' value=".$_COOKIE['sesion'].">";
	echo "<input type='hidden' name='idm' value=".$_GET['id'].">";
	echo "<br>";
	echo "Escribe un comentario:<br>";
	echo "<input name='comment' type='text' style='width:20%'>";
	echo "<input type='submit' value='Comentar' name='botonEnviar' style='background-color:lightyellow'>";
}

?>
</html>
