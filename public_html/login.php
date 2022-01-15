<?php

$user = $_GET["username_login"];
$password = $_GET["password_login"];

try {
        $pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
}catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
};

if(isset($_GET["LoginBtnAction"]))
{
        $passwordHashed = sha1($password);
        $queryPass = "SELECT name,passwd FROM users WHERE users.name = '$user' AND users.passwd = '$passwordHashed'";

        $resultPass = $pdo->query($queryPass);
        $finalResult=$resultPass->fetch(PDO::FETCH_ASSOC);

        if ($finalResult)
        {
                setcookie('sesion',$finalResult['id']);
                echo '<script>document.location = "principal.php"</script>';
        }else{
                echo "<script> alert('Credenciales incorrectos.' + $finalResult)</script>";
                echo "<script>document.location = 'index.html'</script>";
        }
}
?>
