<?php

$name = $_POST["username_register"];
$email = $_POST["email_register"];
$password = $_POST["password_register"];
$password2 = $_POST["confirm_password_register"];
$age = $_POST["age_register"];
$gender = $_POST["gender_register"];
$occupation = $_POST["occupation_register"];
$photo = $_FILES['file_register']['name'];

require_once('utils.php');
$pdo = connectToDb();

if(isset($_POST["RegisterBtn"])){

        if ($password == $password2){
                $queryGetPic = "SELECT pic FROM users";
                $resultGetPic = $pdo->query($queryGetPic);
                while ($pic=$resultGetPic->fetch(PDO::FETCH_ASSOC)){
                        if ($pic['pic']==$photo){
                                $i = 1;
                                $nameWithoutExtension = pathinfo($photo);
                                $photo = $nameWithoutExtension['filename'].$i.'.'.$nameWithoutExtension['extension'];
                        }
                }

                $pass_hash = sha1($password);
                $queryRegister = "INSERT INTO users(name, edad, sex, ocupacion, pic, passwd, email) values ('$name', '$age','$gender', '$occupation', '$photo', '$pass_hash', '$email')";
                $resultRegister = $pdo->query($queryRegister);
                $route = 'images/'.$photo;
                move_uploaded_file($_FILES['file_register']['tmp_name'],$route);
                if($queryRegister){
                $queryGetUserId="SELECT id FROM users WHERE users.name='$name'";
                $resultUserId = $pdo->query($queryGetUserId);
                $userId=$resultUserId->fetch(PDO::FETCH_ASSOC);
                echo "<script>alert('Registered user ')</script>";
                setcookie('session',$name, time()+3600, '/');
                setcookie('session_id',$userId['id'], time()+3600, '/');
                echo "<script>window.location = '../pages/main.php' </script>";
                }
        }
        else {
                echo "<script> alert('The password doesn't match. ')</script>";
                echo"<script>window.location= 'index.html'</script>";
        }
}
?>
