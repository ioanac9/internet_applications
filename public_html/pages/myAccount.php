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

            $pdo = connectToDb();

            $session = $_COOKIE['session_id'];
            $queryGetUser = "SELECT * FROM users WHERE users.id='$session'";
            $user = $pdo->query($queryGetUser)->fetch(PDO::FETCH_ASSOC);

                echo "<div class='account-container'>";
                    echo "<img src= '../photos/".$user["pic"]."'>";
                    echo "<div class='account-info'>";
                        echo "<div><span class='desc'>Name: </span>".$user["name"]."</div>";
                        echo "<div><span class='desc'>Age: </span>".$user["edad"]."</div>";
                        echo "<div><span class='desc'> Occupation: </span>".$user["ocupacion"]."</div>";
                        echo "<div class='btn-container'>";
                            echo "<a href='updateAccount.php'><button class='submit-btn'>Update your information</button></a>";
                            echo "<button class='submit-btn' onclick='remove()'> Delete account</button>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
        ?>

        <div class='recommendations-container'>
        <h2 style='margin-right: 20px'>Recommendations:</h2>
        <div class='btn-container'>
            <a style='height: 100%; display: flex; justify-content: center; align-items:center' class='submit-btn' href='../scripts/recommandations.php'>Update recommendations</a>
            <a style='height: 100%; display: flex; justify-content: center; align-items:center' class='submit-btn' href='./searchRecommended.php'>Search recommendations</a>
        </div>
    </body>
</html>
