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
        <link rel="stylesheet" type="text/css" href="styling/styles.css">

    <!--  Fonts  -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam+Pro:wght@200&family=Poppins:wght@300&display=swap" rel="stylesheet">

    <!--  JS  -->

    </head>
    <body>
        <div class="nav-bar">
            <a href='principal.php'>
                <img class='logo' src="images/logo_movie.png" alt="logo of the company.">
            </a>
            <div class='nav-bar-menu'>
                <?php
                    if (isset($_COOKIE['sesion'])) {
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

        <div class='margin-top-menu'></div>

        <?php
            try {
                    $pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
            } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
            };

            $query = "SELECT * FROM movie";
            $result = $pdo->query($query);
        ?>

        <?php
            echo "<div id='movies-container' style='width:100%' border='1'>";
            $queryPonderada = "SELECT score FROM user_score";
            $resultPond = $pdo->query($queryPonderada);
            $suma2=0;
            $cnt2 = 0;
            while ($lll=$resultPond->fetch(PDO::FETCH_ASSOC)){
                $suma2 = $suma2 + $lll['score'];
                $cnt2 = $cnt2 + 1;
            }
            $media2 = $suma2/$cnt2;
            while ($l=$result->fetch(PDO::FETCH_ASSOC)){
                $url_pic = $l["url_pic"];
                if (strpos($url_pic, 'MV') !== false) {
                    echo "<div class='container'>";
                        echo "<div><img width ='150' heigth='211' src= 'images/".$l["url_pic"]."'></div>";
                        echo "<div class='back-card'><a href='searchInfo.php?id=".$l['id']."'>".$l["title"]."</a>";
                        $queryScore = "SELECT score FROM user_score WHERE user_score.id_movie= ".$l['id'];
                        $resultScore = $pdo->query($queryScore);
                        $suma = 0;
                        $cnt = 0;
                        while ($ll=$resultScore->fetch(PDO::FETCH_ASSOC)){
                            $suma = $suma + $ll['score'];
                            $cnt = $cnt + 1;
                        }
                        $media = $suma/$cnt;
                        echo $media;
                        echo "<span>Total ratings: ".$cnt."</span>";
                        echo "<span>".$l["date"]."</span>";
                        echo "</div>";
                    echo "</div>";
                }
            }
        ?>
    </body>
</html>
