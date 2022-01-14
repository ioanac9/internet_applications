<?php

$name = $_POST["Name"];
$password = $_POST["Password"];
$password2 = $_POST["Password2"];
$age = $_POST["Age"];
$gender = $_POST["Gender"];
$occupation = $_POST["Occupation"];
$photo = $_FILES['Photo']['name'];

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
                                $photo = $nameWithoutExtension['filename'].$i.'.'.$nameWithoutExtension['extension'];                        }
                }

                $pass_hash = sha1($password);
                $queryRegistrar = "INSERT INTO users(name, edad, sex, ocupacion, passwd) values
                ('$name', '$age','$gender', '$occupation', '$photo', '$pass_hash')";
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

