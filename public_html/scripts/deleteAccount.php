<?php
    try {
        $pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
    }catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    };
    $session = $_COOKIE['session'];
    $queryDeleteAccount = "DELETE FROM users WHERE name = '$session'";
    $resultDeleteAccount=$pdo->query($queryDeleteAccount);
    $queryDeleteComments = "DELETE FROM moviecomments WHERE user_id = '$session'";
    $resultDeleteComments=$pdo->query($queryDeleteComments);

    setcookie('session',1,time()-3600);
    setcookie('session_id',1,time()-3600);

echo "<script> window.location = '../index.html'</script>";
?>
