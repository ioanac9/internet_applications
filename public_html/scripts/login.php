<?php
        require_once('utils.php');
        $pdo = connectToDb();

        $user = $_GET["username_login"];
        $password = $_GET["password_login"];

        if (isset($_GET["LoginBtn"])) {
                $passwordHashed = sha1($password);
                $queryPass = "SELECT name,passwd,id FROM users WHERE (users.name = '$user' OR users.email = '$user' OR users.id = '$user') AND users.passwd = '$passwordHashed'";

                $resultPass = $pdo->query($queryPass);
                $finalResult=$resultPass->fetch(PDO::FETCH_ASSOC);

                if ($finalResult)
                {
                        setcookie('session',$finalResult['name'], time()+3600, '/');
                        setcookie('session_id',$finalResult['id'], time()+3600, '/');
                        echo '<script>document.location = "../pages/main.php"</script>';
                }else{
                        echo "<script> alert('Invalid credentials provided' + $finalResult)</script>";
                        echo "<script>document.location = '../index.html'</script>";
                }
        }
?>
