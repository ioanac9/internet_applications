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
</head>
<body>
<div class="nav-bar">
    <a href='pages/main.php'>
        <img class='logo' src="../images/logo_movie.png" alt="logo of the company.">
    </a>
    <div class='nav-bar-menu'>
        <?php
        if (isset($_COOKIE['session'])) {
            echo "<a class='submit-btn' href='myAccount.php'>My account</a>";
            echo "<form action='../scripts/logout.php' method='GET'>";
            echo "<input class='submit-btn' type='submit' name='exit' value='Logout'/>";
            echo "</form>";
        } else {
            echo "<a class='submit-btn' href='../index.html'>Login/Register</a>";
        }
        ?>
    </div>
</div>

<h1 class="margin-top-menu">Recommended movies </h1>

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

