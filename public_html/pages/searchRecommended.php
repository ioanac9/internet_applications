<html>
<head>
<title>TVTIME</title>
<link rel="stylesheet" type="text/css" href="../styling/styles.css">
</head>
<body>
<h1><a href = "main.php">TVT</a></h1>
<h1 align='center'>Recommended movies </h1>

<?php
        try {
                $pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
        }catch (PDOException $e) {
                echo 'Connection failed: '. $e->getMessage();
        };
                echo "<div class='recommended-movies' stlye='width:100%; margin-top:50px;'>";
                $queryRec= "SELECT * FROM recs WHERE recs.user_id='".$_COOKIE["session_id"]."' ORDER BY recs.rec_score DESC";
                $resultRec = $pdo->query($queryRec);
                        for ($i = 0; $i < 5; $i++) {
                                $rec=$resultRec->fetch(PDO::FETCH_ASSOC);
                                $queryMov= "SELECT id,title,url_pic FROM movie WHERE movie.id=".$rec['movie_id'];
                                $resultMov = $pdo->query($queryMov);
                                $recMovie=$resultMov->fetch(PDO::FETCH_ASSOC);
                                echo "<div class='container'>";
                                      echo "<div><img src= '../images/".$recMovie["url_pic"]."'></div>";
                                      echo "<div class='back-card'>";
                                      echo "<a href='searchInfo.php?id=".$recMovie['id']."'>".$recMovie["title"]."</a>";
                                      echo "<div>Rating: ".$rec["rec_score"]."</div>";
                                echo "</div>";
                                echo "</div>";
                        }
                echo "</div>"
      ?>
      </body>
</html>

