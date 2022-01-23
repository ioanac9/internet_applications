<?php
function connectToDb() {
    try {
        return new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    };
}

function headerPrinter() {
    echo '<div class="nav-bar">';
    echo '        <a href="main.php">';
    echo '            <img class="logo" src="../images/logo_movie.png" alt="logo of the company.">';
    echo '       </a>';
    echo '       <div class="nav-bar-menu">';
    if (isset($_COOKIE['session'])) {
        echo "<a class='submit-btn' href='myAccount.php'>My account</a>";
        echo "<form action='../scripts/logout.php' method='GET'>";
        echo "<input class='submit-btn' type='submit' name='exit' value='Logout'/>";
        echo "</form>";
    } else {
        echo "<a class='submit-btn' href='../index.html'>Login/Register</a>";
    }
    echo "        </div>";
    echo "</div>";
}