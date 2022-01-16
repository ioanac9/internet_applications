<html lang="en">
    <head>
        <title>Update My Account</title>

        <!--  Meta Data  -->
        <meta charset="UTF-8">
        <meta name="description" content="Update my account page">
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
            <a href='main.php'>
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
    <div class="margin-top-menu">
        <h1 align='center'>Update account information</h1>
        <form class='update-info' action = "../scripts/update.php" method="POST" enctype="multipart/form-data">
            <?php
                try {
                    $pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
                } catch (PDOException $e) {
                    echo 'Connection failed: ' . $e->getMessage();
                };

                $session = $_COOKIE['session'];
                $query = "SELECT * FROM users WHERE users.name='$session'";
                $result = $pdo->query($query);

                while ($l=$result->fetch(PDO::FETCH_ASSOC)){
                    echo "<label class='form-row'> Username:<input name='username_register' type= 'text' value = '".$l["name"]."'></label>";
                    echo "<label class='form-row'> Password:<input name='password_register' type= 'password'></label>";
                    echo "<label class='form-row'> Confirm Password:<input name='confirm_password_register' type= 'password'></label>";
                    echo "<label class='form-row'> Age:<input name='age_register' type= 'text' value = '".$l["edad"]."'></label>";
                    echo "<label class='form-row'>Gender:</label>";
                    if($l['sex'] == 'M'){
                        echo '<div class="radio-container">';
                        echo '<input type="radio" id="M" name="gender_register" value="M" checked>';
                        echo '<label for="M">Male</label>';
                        echo '</div>';
                        echo '<div class="radio-container">';
                        echo '<input type="radio" id="F" name="gender_register" value="F">';
                        echo '<label for="F">Female</label>';
                        echo '</div>';
                    }else{
                        echo '<div class="radio-container">';
                        echo '<input type="radio" id="M" name="gender_register" value="M">';
                        echo '<label for="M">Male</label><br>';
                        echo '</div>';
                        echo '<div class="radio-container">';
                        echo '<input type="radio" id="F" name="gender_register" value="F" checked>';
                        echo '<label for="F">Female</label>';
                        echo '</div>';
                    }
                    echo "<label class='form-row'> Occupation:<input name='occupation_register' type= 'text' value = '".$l["ocupacion"]."'></label>";
                    echo "<label class='form-row'> Profile photo:<input name='file_register' type= 'file' value = '".$l["pic"]."'></label>";
                    echo  "<input type='submit' value='Submit' name='UpdateBtn' class='submit-btn update-acc'>";
            }
            ?>
        </form>
    </div>
</body>
</html>
