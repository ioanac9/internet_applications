<?php

$movieId = $_POST['movieId'];
$userId = $_POST['userId'];
$comment = $_POST['comment'];

try {
    $pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
};



if(isset($_POST['sendComment'])){

    $query = "INSERT INTO moviecomments(movie_id,user_id,comment) values ('$movieId', '$userId', '$comment')";
    $result = $pdo->query($query);
    echo"<script>window.location= '../pages/searchInfo.php?id=".$movieId."'</script>";

}

?>