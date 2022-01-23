<?php

    $movieId = $_GET['movie_id'];
    $userId = $_GET['user_id'];
    $score = $_GET['score'];

    require_once('utils.php');
    $pdo = connectToDb();

    if(isset($_GET['ReviewBtn'])){
        $query = "UPDATE user_score SET score = '".$score."' WHERE user_score.id_user=".$userId." AND user_score.id_movie=".$movieId;
        $result = $pdo->query($query)->fetch(PDO::FETCH_ASSOC);
        echo"<script>window.location= '../pages/searchInfo.php?id=".$movieId."'</script>";
    }

?>
