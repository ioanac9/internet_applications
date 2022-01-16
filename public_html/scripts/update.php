<?php

$name = $_POST["username_register"];
$password = $_POST["password_register"];
$password2 = $_POST["confirm_password_register"];
$age = $_POST["age_register"];
$gender = $_POST["gender_register"];
$occupation = $_POST["occupation_register"];
$photo = $_FILES['file_register']['name'];

try {
    $pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
};

if(isset($_POST["UpdateBtn"])){

    if (empty($password) == true && empty($password2) == true) {
        echo "<script> alert('You also need to change your password')</script>";
        echo"<script>window.location= '../pages/updateAccount.php'</script>";
    }

    if ($password != $password2) {
        echo "<script> alert('Your passwords needs to match')</script>";
        echo"<script>window.location= '../pages/updateAccount.php'</script>";
    }

    $hashedPassword = sha1($password);
    $session = $_COOKIE['session'];
    $queryToUpdateTheUser = "UPDATE users SET users.name='$name', users.edad = '$age', users.sex = '$gender', users.ocupacion = '$occupation', users.passwd='$hashedPassword' WHERE users.name ='$session'";
    $result = $pdo->query($queryToUpdateTheUser);
    if(empty($foto)==false) {
        $usersPhotosQuery = "SELECT pic FROM users";
        $resultPhoto = $pdo->query($usersPhotosQuery);
        while ($current=$resultPhoto->fetch(PDO::FETCH_ASSOC)){
            if ($current['pic']==$foto){
                $i = 1;
                $nombreSinExtension = pathinfo($foto);
                $foto = $nombreSinExtension['filename'].$i.'.'.$nombreSinExtension['extension'];
            }
        }
        $queryFoto = "UPDATE users SET users.pic = '$foto' WHERE users.name='$session'";
        $result = $pdo->query($queryFoto);
        $ruta = 'fotos/'.$foto;
        move_uploaded_file($_FILES['Foto']['tmp_name'],$ruta);
    }
    echo "<script>alert('Updated successfully')</script>";
    echo "<script>window.location= '../pages/myAccount.php' </script>";
}

