<?php

        $user = $_GET["username_login"];
        $password = $_GET["password_login"];

        try {
                $pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
        } catch (PDOException $e) {
                echo 'Connection failed: ' . $e->getMessage();
        };

        if (isset($_GET["LoginBtn"])) {
                $passwordHashed = sha1($password);
                $queryPass = "SELECT name,passwd,id FROM users WHERE users.name = '$user' AND users.passwd = '$passwordHashed'";

                $resultPass = $pdo->query($queryPass);
                $finalResult=$resultPass->fetch(PDO::FETCH_ASSOC);

                if ($finalResult)
                {
                        setcookie('session',$finalResult['name']);
                        setcookie('session_id',$finalResult['id']);
                        echo '<script>document.location = "../pages/main.php"</script>';
                }else{
                        echo "<script> alert('Invalid credentials provided' + $finalResult)</script>";
                        echo "<script>document.location = 'index.html'</script>";
                }
        }
?>
