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
        }catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
        };

if(isset($_POST["RegisterBtn"])){

        if ($password == $password2){
                $queryy = "SELECT pic FROM users";
                $resultt = $pdo->query($queryy);
                while ($ll=$resultt->fetch(PDO::FETCH_ASSOC)){
                        if ($ll['pic']==$photo){
                                $i = 1;
                                $nameWithoutExtension = pathinfo($photo);
                                $photo = $nameWithoutExtension['filename'].$i.'.'.$nameWithoutExtension['extension'];
                        }
                }

                $pass_hash = sha1($password);
                $queryRegister = "INSERT INTO users(name, edad, sex, ocupacion, pic, passwd) values
                ('$name', '$age','$gender', '$occupation', '$photo', '$pass_hash')";
                $result = $pdo->query($queryRegister);
                $route = 'images/'.$photo;
                move_uploaded_file($_FILES['file_register']['tmp_name'],$route);

                if($queryRegister){
                $q="SELECT id FROM users WHERE users.name='$name'";
                $r = $pdo->query($q);
                $l=$r->fetch(PDO::FETCH_ASSOC);
                echo "<script>alert('Registered user ')</script>";
                setcookie('sesion',$l['name']);
                    echo "<script>window.location = 'principal.php' </script>";
                }
        }
        else {
                echo "<script> alert('The password doesn't match. ')</script>";
                echo"<script>window.location= 'index.html'</script>";
        }
}
?>

