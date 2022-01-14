<?php 

$nombre = $_POST["Nombre"];
$password = $_POST["Password"];
$password2 = $_POST["Password2"];
$edad = $_POST["Edad"];
$sexo = $_POST["Sexo"];
$ocupacion = $_POST["Ocupacion"];
$foto = $_FILES['Foto']['name'];

try { 
	$pdo = new PDO('mysql:host=localhost;dbname=ai33', 'ai33','ai2021');   
 
	}catch (PDOException $e) { 
 
   	echo 'Connection failed: ' . $e->getMessage(); 
 
	}; 

if(isset($_POST["BotonRegistro"])){

   
	if ($password == $password2){
		
		$queryy = "SELECT pic FROM users";
		$resultt = $pdo->query($queryy);
		while ($ll=$resultt->fetch(PDO::FETCH_ASSOC)){
		
			if ($ll['pic']==$foto){
				$i = 1;
				$nombreSinExtension = pathinfo($foto);
				$foto = $nombreSinExtension['filename'].$i.'.'.$nombreSinExtension['extension'];	
			}
		}
		
		$pass_hash = sha1($password);
		$queryRegistrar = "INSERT INTO users(name, edad, sex, ocupacion, pic, passwd) values 										
		('$nombre', '$edad','$sexo', '$ocupacion', '$foto', '$pass_hash')";
		$result = $pdo->query($queryRegistrar);

		$ruta = 'fotos/'.$foto;
		move_uploaded_file($_FILES['Foto']['tmp_name'],$ruta);

     		if($queryRegistrar){
		$q="SELECT id FROM users WHERE users.id=(SELECT max(id) FROM users)";
		$r = $pdo->query($q);
		$l=$r->fetch(PDO::FETCH_ASSOC);
		echo "<script>alert('Usuario registrado')</script>";
		setcookie('sesion',$l['id']);
 		echo "<script>window.location = 'principal.php' </script>";
		}
    

	}

	else { 
		echo "<script> alert('Las contraseñas no coinciden. Pruebe de nuevo por favor')</script>";
		echo"<script>window.location= 'formularioRegistro.html'</script>";		
	}

}


?>