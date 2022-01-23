<html>
<head>
    <title>My Search Recommendations</title>

    <!--  Meta Data  -->
    <meta charset="UTF-8">
    <meta name="description" content="My account page. You can update your account and also delete it">
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
    <script type='text/javascript'>
        function remove(){
            const message = window.confirm('Are you sure you want to delete your account?');
            if (message){
                window.location = '../scripts/deleteAccount.php';
            }else{
                window.location = 'myAccount.php';
            }

        }
    </script>
    <script src="../js/fixBrokenImages.js"></script>

</head>
<body>

<?php
    require_once('utils.php');
    headerPrinter();
    echo '<h1 class="margin-top-menu">Recommended movies </h1>';

    $pdo = connectToDb();
                echo "<div class='recommended-movies' stlye='width:100%; margin-top:50px;'>";
                $queryGetRecommended= "SELECT * FROM recs WHERE recs.user_id='".$_COOKIE["session_id"]."' ORDER BY recs.rec_score DESC";
                $resultRecommended = $pdo->query($queryGetRecommended);
                        for ($i = 0; $i < 5; $i++) {
                                $recommended=$resultRecommended->fetch(PDO::FETCH_ASSOC);
                                $queryGetMovie= "SELECT id,title,url_pic FROM movie WHERE movie.id=".$recommended['movie_id'];
                                $resultMovie = $pdo->query($queryGetMovie);
                                $recommendedMovie=$resultMovie->fetch(PDO::FETCH_ASSOC);
                                echo "<div class='container'>";
                                      echo "<div><img src= '../images/".$recommendedMovie["url_pic"]."'></div>";
                                      echo "<div class='back-card'>";
                                      echo "<a href='searchInfo.php?id=".$recommendedMovie['id']."'>".$recommendedMovie["title"]."</a>";
                                      echo "<div>Rating: ".$recommended["rec_score"]."</div>";
                                echo "</div>";
                                echo "</div>";
                        }
                echo "</div>"
      ?>
      </body>
</html>

