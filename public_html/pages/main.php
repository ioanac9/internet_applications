<html>
    <head>
        <title>Movies</title>

    <!--  Meta Data  -->
        <meta charset="UTF-8">
        <meta name="description" content="Register and Login page created for InternetApplication class">
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

            echo "<div class='margin-top-menu'></div>";

            $queryGetAllMovies = "SELECT * FROM movie";
            $resultQueryMovies = $pdo->query($queryGetAllMovies);

            $queryScoreForComputingWeight = "SELECT score FROM user_score";
            $resultPond = $pdo->query($queryScoreForComputingWeight);
            $sumOfAllTheScores=0;
            $howManyScores = 0;
            while ($scoreElement=$resultPond->fetch(PDO::FETCH_ASSOC)){
                $sumOfAllTheScores = $sumOfAllTheScores + $scoreElement['score'];
                $howManyScores += + 1;
            }
            $averageScores = $sumOfAllTheScores / $howManyScores;

            $queryGetAllMoviesCount = "SELECT COUNT(*) FROM movie";
            $resultCount = $pdo->query($queryGetAllMoviesCount)->fetch(PDO::FETCH_ASSOC);
            $noOfMovies = $resultCount['COUNT(*)'];

            echo "<div id='movies-container' style='width:100%'>";
            while ($movie=$resultQueryMovies->fetch(PDO::FETCH_ASSOC)){
                echo "<div class='container'>";
                    echo "<div><img src= '../images/".$movie["url_pic"]."'></div>";
                    echo "<div class='back-card'><a href='searchInfo.php?id=".$movie['id']."'>".$movie["title"]."</a>";
                    $queryScore = "SELECT score FROM user_score WHERE user_score.id_movie= ".$movie['id'];
                    $resultScore = $pdo->query($queryScore);
                    $sunOfAllTheScores = 0;
                    $counter = 0;
                    while ($score2=$resultScore->fetch(PDO::FETCH_ASSOC)){
                        $sunOfAllTheScores += $score2['score'];
                        $counter += 1;
                    }
                    $media = round($sunOfAllTheScores/$counter, 2);
                    echo "<span>Average Rating: ".$media."</span>";
                    $weight = ($noOfMovies * $averageScores + $counter * $media)/($noOfMovies+ $counter);
                    echo "<span>Weight: ".$weight."</span>";
                    echo "<span>Total ratings: ".$counter."</span>";
                    echo "<span style='padding: 0 20px; text-overflow: ellipsis'>Description: ".$movie['desc']."</span>";
                    echo "<span>".$movie["date"]."</span>";
                    echo "</div>";
                echo "</div>";

            }
        ?>
    </body>
</html>
