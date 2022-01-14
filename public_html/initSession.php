<?php

$user = $_GET["Name"];
$password = $_GET["Password"];

try {
        $pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');

        }catch (PDOException $e) {

        echo 'Connection failed: ' . $e->getMessage();

        };


if(isset($_GET["LoginBtn"]))
{


        $Pass_hash = sha1($password);
        $queryPass = "SELECT id,passwd FROM users WHERE users.id = '$user' AND users.passwd = '$Pass_hash'";

        $resultPass = $pdo->query($queryPass);
        $l=$resultPass->fetch(PDO::FETCH_ASSOC);

        if ($l)
        {
                setcookie('sesion',$l['id']);
                echo '<script>document.location = "principal.php"</script>';
        }else{
                echo "<script> alert('Credenciales incorrectos.')</script>";
                echo "<script>document.location = 'index.html'</script>";
        }
}





?>
