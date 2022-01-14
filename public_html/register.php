<?php

$name = $_POST["Name"];
$password = $_POST["Password"];
$password2 = $_POST["Password2"];
$age = $_POST["Age"];
$gender = $_POST["Gender"];
$Ocupation = $_POST["Ocupation"];
$photo = $_FILES['photo']['name'];

try {
        $pdo = new PDO('mysql:host=localhost;dbname=ai33', 'ai33','ai2021');

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
                                $photo = $nameWithoutExtension['filename'].$i.'.'.$nameWithoutExtension['extension'];                        }
                }

                $pass_hash = sha1($password);
                $queryRegistrar = "INSERT INTO users(name, age, gender, ocupation, photo, passwd) values
                ('$name', '$age','$gender', '$ocupation', '$photo', '$pass_hash')";
                $result = $pdo->query($queryRegister);

                $route = 'photos/'.$photo;
                move_uploaded_file($_FILES['Photo']['tmp_name'],$route);

                if($queryRegister){
                $q="SELECT id FROM users WHERE users.id=(SELECT max(id) FROM users)";
                $r = $pdo->query($q);
                $l=$r->fetch(PDO::FETCH_ASSOC);
                echo "<script>alert('Registered user ')</script>";
                setcookie('sesion',$l['id']);
                echo "<script>window.location = 'principal.php' </script>";
                }


        }

        else {
                echo "<script> alert('The password doesn't match. ')</script>";
                echo"<script>window.location= 'index.html'</script>";
        }

}


?>

