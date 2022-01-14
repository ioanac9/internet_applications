
<?php

$usuario = $_GET["IDNombre"];
$password = $_GET["Pass"];

try { 
	$pdo = new PDO('mysql:host=localhost;dbname=ai33', 'ai33','ai2021');  
 
	}catch (PDOException $e) { 
 
   	echo 'Connection failed: ' . $e->getMessage(); 
 
	};
    

if(isset($_GET["BotonEntrar"]))
{


	$Pass_hash = sha1($password);
	$queryPass = "SELECT id,passwd FROM users WHERE users.id = '$usuario' AND users.passwd = '$Pass_hash'";

	$resultPass = $pdo->query($queryPass);
	$l=$resultPass->fetch(PDO::FETCH_ASSOC);

	if ($l)
	{
		setcookie('sesion',$l['id']);
        	echo '<script>document.location = "principal.php"</script>';
	}else{
		echo "<script> alert('Credenciales incorrectos.')</script>";
		echo "<script>document.location = 'iniciarSesion.html'</script>";
	}
}





?>
