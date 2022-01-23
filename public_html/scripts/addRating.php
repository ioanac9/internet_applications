<?php

$movieId = $_GET['movie_id'];
$userId = $_GET['user_id'];
$score = $_GET['score'];

require_once('utils.php');
$pdo = connectToDb();

if(isset($_GET['ReviewBtn'])){
    $time = date('Y/m/d h:i:s', time());
    echo "$time";
    $query = "INSERT INTO user_score(id_user, id_movie, score, time) VALUES ('".$userId."' ,'".$movieId."' ,'".$score."' ,'".$time."')";
    $result = $pdo->query($query);
    echo"<script>window.location= '../pages/searchInfo.php?id=".$movieId."'</script>";
}
