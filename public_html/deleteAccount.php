<?php
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
    }catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    };
    $session = $_COOKIE['session'];
    $query = "DELETE FROM users WHERE name = '$session'";
    $result=$pdo->query($query);
    $query1 = "DELETE FROM moviecomments WHERE user_id = '$session'";
    $result1=$pdo->query($query1);

    setcookie('session',1,time()-3600);
    echo "<script> window.location = 'index.html'</script>";
?>
