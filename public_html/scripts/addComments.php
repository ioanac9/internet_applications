<?php

$movieId = $_POST['movieId'];
$userId = $_POST['userId'];
$comment = $_POST['comment'];

require_once('utils.php');
$pdo = connectToDb();


if(isset($_POST['sendComment'])){

    $queryAddMovieComment = "INSERT INTO moviecomments(movie_id,user_id,comment) values ('$movieId', '$userId', '$comment')";
    $resultAddMovieComment = $pdo->query($queryAddMovieComment);
    echo"<script>window.location= '../pages/searchInfo.php?id=".$movieId."'</script>";

}

?>
