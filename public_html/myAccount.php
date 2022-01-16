<html lang="en">
    <head>
        <title>My Account</title>

        <!--  Meta Data  -->
        <meta charset="UTF-8">
        <meta name="description" content="My account page. You can update your account and also delete it">
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
        <script type='text/javascript'>
            function remove(){
                const message = window.confirm('Are you sure you want to delete your account?');
                if (message){
                    window.location = 'deleteAccount.php';
                }else{
                    window.location = 'myAccount.php';
                }

            }
        </script>
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
            }catch (PDOException $e) {
                echo 'Connection failed: '. $e->getMessage();
            };

            $session = $_COOKIE['session'];
            $query = "SELECT * FROM users WHERE users.name='$session'";

            $result = $pdo->query($query);


            while ($l=$result->fetch(PDO::FETCH_ASSOC)) {
                echo "<div class='account-container'>";
                    echo "<img width ='150' heigth='211' src= 'fotos/".$l["pic"]."'>";
                    echo "<div class='account-info'>";
                        echo "<div><span class='desc'>Name: </span>".$l["name"]."</div>";
                        echo "<div><span class='desc'>Age: </span>".$l["edad"]."</div>";
                        echo "<div><span class='desc'> Occupation: </span>".$l["ocupacion"]."</div>";
                        echo "<div class='btn-container'>";
                            echo "<a href='updateAccount.php'><button class='submit-btn' style='height: 100%'>Update your information</button></a>";
                            echo "<input type='button' class='submit-btn' onclick='remove()' value='Delete account'>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
            }
        ?>

        <div class='account-container'>
        <h2 style='margin-right: 20px'>Recomendaciones:</h2>
        <div class='btn-container'>
            <a style='height: 100%; display: flex; justify-content: center; align-items:center' class='submit-btn' href='recommandations.php'>Update recommendations</a>
            <a style='height: 100%; display: flex; justify-content: center; align-items:center' class='submit-btn' href='searchRecommended.php'>Search recommendations</a>
        </div>
    </body>
</html>
