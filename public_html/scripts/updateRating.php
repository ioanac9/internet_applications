<?php

    $movieId = $_GET['mover_id'];
    $userId = $_GET['user_id'];
    $score = $_GET['score'];

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    };

    if(isset($_GET['ReviewBtn'])){
        $query = "UPDATE user_score SET user_score.id_user = '$userId', user_score.id_movie = '$movieId', user_score.score = '$score' WHERE user_score.id_user='$userId' AND user_score.id_movie=$movieId";
        $result = $pdo->query($query);
        echo "<script> alert('Rank modified!')</script>";
        echo"<script>window.location= '../pages/searchInfo.php?id=".$movieId."'</script>";
    }

?>
