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
        <div class="nav-bar">
            <a href='../pages/main.php'>
                <img class='logo' src="../images/logo_movie.png" alt="logo of the company.">
            </a>
            <div class='nav-bar-menu'>
                <?php

                if (isset($_COOKIE['session'])) {
                    echo "<a class='submit-btn' href='../pages/myAccount.php'>My account</a>";
                    echo "<form action='logout.php' method='GET'>";
                    echo "<input class='submit-btn' type='submit' name='exit' value='Logout'/>";
                    echo "</form>";
                } else {
                    echo "<a class='submit-btn' href='../index.html'>Login/Register</a>";
                }
                ?>
            </div>
        </div>
        <h1>Recommended Movies</h1>

        <?php
            $userId = $_COOKIE["session_id"];
            $movieID = $_GET["mover_id"];

            try {
                $pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
            } catch (PDOException $e) {
                echo 'Connection failed: '. $e->getMessage();
            };

            echo "<table border='1' align='center' style='width:60%'>";
                echo "<tr>";
                    echo "<th width ='150' heigth='211'>Photo</th>";
                    echo "<th>Title</th>";
                    echo "<th>Rank</th>";
                echo "</tr>";
                $queryRec= "SELECT * FROM recs WHERE recs.user_id='$userId' ORDER BY recs.rec_score DESC";
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
    </body>
</html>