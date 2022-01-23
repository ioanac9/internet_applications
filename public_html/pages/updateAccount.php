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
    <?php
        require_once('utils.php');
        headerPrinter();
    ?>
    <div class="margin-top-menu">
        <h1 align='center'>Update account information</h1>
        <form class='update-info' action = "../scripts/update.php" method="POST" enctype="multipart/form-data">
            <?php
                require_once('utils.php');
                $pdo = connectToDb();

                $session = $_COOKIE['session'];
                $queryGetUser = "SELECT * FROM users WHERE users.name='$session'";
                $user = $pdo->query($queryGetUser)->fetch(PDO::FETCH_ASSOC);
                    echo "<label class='form-row'> Username:<input name='username_register' type= 'text' value = '".$user["name"]."'></label>";
                    echo "<label class='form-row'> Password:<input name='password_register' type= 'password'></label>";
                    echo "<label class='form-row'> Confirm Password:<input name='confirm_password_register' type= 'password'></label>";
                    echo "<label class='form-row'> Age:<input name='age_register' type= 'text' value = '".$user["edad"]."'></label>";
                    echo "<label class='form-row'>Gender:</label>";
                    if($user['sex'] == 'M'){
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
                    echo "<label class='form-row'> Occupation:<input name='occupation_register' type= 'text' value = '".$user["ocupacion"]."'></label>";
                    echo "<label class='form-row'> Profile photo:<input name='file_register' type= 'file' value = '".$user["pic"]."'></label>";
                    echo  "<input type='submit' value='Submit' name='UpdateBtn' class='submit-btn update-acc'>";
            ?>
        </form>
    </div>
</body>
</html>
