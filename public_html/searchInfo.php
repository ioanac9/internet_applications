<html>
<head>
    <title>Movie By Id</title>

    <!--  Meta Data  -->
    <meta charset="UTF-8">
    <meta name="description" content="See Movie page">
    <meta name="keywords" content="HTML, CSS, JavaScript, php">
    <meta name="author" content="Oscar Gal | Ioana Constantinescu">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <!--  CSS  -->
    <link rel="stylesheet" type="text/css" href="styling/styles.css">

    <!--  Fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@200&family=Poppins:wght@300&display=swap" rel="stylesheet">

    <!--  JS  -->

    </head>
<body>
    <div class="nav-bar">
        <a href='main.php'>
            <img class='logo' src="images/logo_movie.png" alt="logo of the company.">
        </a>
        <div class='nav-bar-menu'>
            <?php
                if (isset($_COOKIE['session'])) {
                        echo "<a class='submit-btn' href='myAccount.php'>My account</a>";
                        echo "<form action='logout.php' method='GET'>";
                            echo "<input class='submit-btn' type='submit' name='exit' value='Logout'/>";
                        echo "</form>";
                } else {
                        echo "<a class='submit-btn' href='index.html'>Login/Register</a>";
                }
            ?>
        </div>
    </div>

    <?php
        try {
		    $pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
	    } catch (PDOException $e) {
		    echo 'Connection failed: ' . $e->getMessage();
	    };
        $session = $_COOKIE['session'];
        $query = "SELECT * FROM movie WHERE movie.id=".$_GET['id'];
	    $result = $pdo->query($query);

        $l=$result->fetch(PDO::FETCH_ASSOC);
        echo "<div class='movie-container-single'>";
            echo "<div class=movie-info>";
                echo "<img class='movie-info-single' src= 'images/".$l["url_pic"]."'/>";
                echo "<div class='text-movie-container'>";
                    echo "<div><h1>".$l["title"]."</h1></div>";
                    echo "<div>";
                        echo "<span class='desc'> Genre: </span>";
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
                        echo "<div style='display:flex; align-items:center'><h2>Comments: </h2></div>";
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
        if (isset($session)) {
            echo "<h1>Your score for the movie <img style='height:30px' src='images/star.png'/></h1>";
	        $movieId = $_GET['id'];
	        $queryMovieScore = "SELECT * FROM user_score WHERE user_score.id_user='$session' AND user_score.id_movie='$movieId'";
	        $resultQueryMovieScore = $pdo->query($queryMovieScore);
	        $userScore=$resultQueryMovieScore->fetch(PDO::FETCH_ASSOC);
	        if ($userScore != 0) {
	            echo "<form action = 'updateRating.php' method='GET'>";
	        }
	        else {
	            echo "<form action = 'addRating.php' method='GET'>";
	        }

            $query = "SELECT * FROM users WHERE users.name='$session'";
            $result = $pdo->query($query);
            $userid = '';
            while ($l=$result->fetch(PDO::FETCH_ASSOC)) {
                $userid = $l['id'];
                echo "<input type='hidden' name='user_id' value=".$l['id'].">";
            }
	        echo "<input type='hidden' name='mover_id' value=".$_GET['id'].">";

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
            echo	"<input style='margin-left: 20px;' class='submit-btn' type='submit' value='Rank' name='ReviewBtn'>";
            echo	"</form>";

            $idmovie =$_GET['id'];
            $queryPunt = "SELECT * FROM user_score WHERE user_score.id_user='$session' AND user_score.id_movie=$idmovie";
            $resu = $pdo->query($queryPunt);
            $t=$resu->fetch(PDO::FETCH_ASSOC);
            if ($t != 0) {
	            echo "<p>Your score of the movie is: ".$t["score"]." </p>";
	        }

	    }


        if (isset($_COOKIE['session'])) {
            echo '<form action="addComments.php" method="POST">';
            echo "<input type='hidden' name='userId' value=".$userid.">";
            echo "<input type='hidden' name='movieId' value=".$_GET['id'].">";
            echo "<br>";
            echo "Write a comment:<br>";
            echo "<input name='comment' type='text' style='width:20%'>";
            echo "<input class='submit-btn' type='submit' value='Comment' name='sendComment'>";
        }

    ?>
    </body>
</html>
