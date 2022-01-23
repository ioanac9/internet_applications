<html lang="en">
    <head>
        <title>Add Rating</title>

        <!--  Meta Data  -->
        <meta charset="UTF-8">
        <meta name="description" content="Add rating and see your ratings">
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

    </head>
    <body>
        <?php
            $userId = $_COOKIE["session_id"];
            $movieID = $_GET["movie_id"];

            require_once('dbConnection.php');
            $pdo = connectToDb();

            echo "<h1>Recommended Movies</h1>";
            headerPrinter();

            echo "<table border='1' align='center' style='width:60%'>";
                echo "<tr>";
                    echo "<th width ='150''>Photo</th>";
                    echo "<th>Title</th>";
                    echo "<th>Rank</th>";
                echo "</tr>";
                $queryGetRecommended= "SELECT * FROM recs WHERE recs.user_id='$userId' ORDER BY recs.rec_score DESC";
                $recommended = $pdo->query($queryGetRecommended)->fetch(PDO::FETCH_ASSOC);

                for ($i = 0; $i < 10; $i++) {
                    $queryGetMovie= "SELECT id,title,url_pic FROM movie WHERE movie.id=".$recommended['movie_id'];
                    $movie = $pdo->query($queryGetMovie)->fetch(PDO::FETCH_ASSOC);
                    echo "<tr>";
                    echo "<td><img width ='150' src= '../images/".$movie["url_pic"]."'></td>";
                    echo "<td>".$movie["title"]."</td>";
                    echo "<td>".$recommended["rec_score"]."</td>";
                    echo "</tr>";
                }
        ?>
    </body>
</html>
