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
    <link rel="stylesheet" type="text/css" href="../styling/styles.css">

    <!--  Fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@200&family=Poppins:wght@300&display=swap" rel="stylesheet">

    <!--  JS  -->
    <script src="../js/fixBrokenImages.js"></script>

</head>
<body>

    <?php
        require_once('utils.php');
        headerPrinter();

        $pdo = connectToDb();
        $session = $_COOKIE['session'];
        $session_id = $_COOKIE['session_id'];

        $queryGetMovie = "SELECT * FROM movie WHERE movie.id=".$_GET['id'];
	    $resultMovie = $pdo->query($queryGetMovie);

        $movie=$resultMovie->fetch(PDO::FETCH_ASSOC);
        echo "<div class='movie-container-single'>";
            echo "<div class=movie-info>";
                echo "<img class='movie-info-single' src= '../images/".$movie["url_pic"]."'/>";
                echo "<div class='text-movie-container'>";
                    echo "<div><h1>".$movie["title"]."</h1></div>";
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
                    echo "<div> <span class='desc'> Description: </span> ".$movie["desc"]."</div>";
                    echo "<div> <span class='desc'> Release date: </span>".$movie["date"]."</div>";
                    $queryC = "SELECT * FROM moviecomments WHERE moviecomments.movie_id=".$_GET['id'];
                    $resultC = $pdo->query($queryC);
                    echo "<div class='reviews'>";
                        echo "<div style='display:flex; align-items:center'><h2>Reviews: </h2></div>";
                        echo "<div class='comments-section'>";
                            while($a=$resultC->fetch(PDO::FETCH_ASSOC)){
                                $queryU = "SELECT * from users WHERE users.id =".$a['user_id'];
                                $resultU = $pdo->query($queryU);
                                $b=$resultU->fetch(PDO::FETCH_ASSOC);
                                if (isset($b['name'])) {
                                    echo "<div class='single-review'>";
                                    echo "<span class='desc'>".$b['name'].": </span>";
                                    echo "<span>".$a['comment']."</span>";
                                    echo "</div>";
                                } else {
                                    echo "<div class='single-review'>";
                                    echo "<span class='desc'>Removed user</span>";
                                    echo "<span>".$a['comment']."</span>";
                                    echo "</div>";
                                }
                            }
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
        if (isset($session)) {
            echo "<div class='rating-container'>";
            echo "<div class='score-title'><h1>Your score for the movie</h1> <img style='height:30px' src='../images/star.png'/></div>";
	        $movieId = $_GET['id'];
	        $queryMovieScore = "SELECT * FROM user_score WHERE user_score.id_user='$session_id' AND user_score.id_movie='$movieId'";
	        $resultQueryMovieScore = $pdo->query($queryMovieScore);
	        $userScore=$resultQueryMovieScore->fetch(PDO::FETCH_ASSOC);
	        if (isset($userScore['score'])) {
	            echo "<form action = '../scripts/updateRating.php' method='GET'>";
                echo "<h2>Your current score is: ".$userScore['score']."</h2>";
	        }
	        else {
	            echo "<form class='add-rating' action = '../scripts/addRating.php' method='GET'>";
	        }

//            $query = "SELECT * FROM users WHERE users.name='$session'";
//            $result = $pdo->query($query);
//            $userid = '';
//            while ($l=$result->fetch(PDO::FETCH_ASSOC)) {
//                $userid = $l['id'];
            echo "<input type='hidden' name='user_id' value=".$session_id.">";

	        echo "<input type='hidden' name='movie_id' value=".$_GET['id'].">";
            echo   "<div class='add-rating-container'>";
            echo   "<div class='radio-container'>";
	        echo   "<input id='radio1' type='radio' name='score' value='1'>";
	        echo    "<label for='radio1'>1</label>";
	        echo    "</div>";
	        echo   "<div class='radio-container'>";
	        echo   "<input id='radio2' type='radio' name='score' value='2'>";
	        echo    "<label for='radio2'>2</label>";
	        echo    "</div>";
	        echo   "<div class='radio-container'>";
            echo   "<input id='radio3' type='radio' name='score' value='3'>";
            echo    "<label for='radio3'>3</label>";
            echo    "</div>";
            echo   "<div class='radio-container'>";
            echo   "<input id='radio4' type='radio' name='score' value='4'>";
            echo    "<label for='radio4'>4</label>";
            echo    "</div>";
            echo   "<div class='radio-container'>";
            echo   "<input id='radio5' type='radio' name='score' value='5'>";
            echo    "<label for='radio5'>5</label>";
            echo    "</div>";
            echo	"<input style='margin-left: 20px;' class='submit-btn' type='submit' value='Rank' name='ReviewBtn'>";
            echo    "</div>";
            echo	"</form>";

            $idmovie =$_GET['id'];
            $queryGetRating = "SELECT * FROM user_score WHERE user_score.id_user='$session' AND user_score.id_movie=$idmovie";
            $rating = $pdo->query($queryGetRating)->fetch(PDO::FETCH_ASSOC);
            if ($rating != 0) {
	            echo "<p>Your score of the movie is: ".$rating["score"]." </p>";
	        }

	    }


        if (isset($_COOKIE['session'])) {
            echo '<form class="add-comment-form" action="../scripts/addComments.php" method="POST">';
            echo "<input type='hidden' name='userId' value=".$session_id.">";
            echo "<input type='hidden' name='movieId' value=".$_GET['id'].">";
            echo "<br>";
            echo "Write a comment:<br>";
            echo "<textarea name='comment' style='height:120px' type='text'></textarea>";
            echo "<input class='submit-btn' type='submit' value='Comment' name='sendComment'>";
            echo    "</div>";

        }

    ?>
    </body>
</html>
