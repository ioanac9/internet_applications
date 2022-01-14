<?php 

$nombre = $_POST["Nombre"];
$password = $_POST["Password"];
$password2 = $_POST["Pass"];
$edad = $_POST["Edad"];
$sexo = $_POST["Sexo"];
$ocupacion = $_POST["Ocupacion"];
$foto = $_FILES['Foto']['name'];

try { 
	$pdo = new PDO('mysql:host=localhost;dbname=ai33', 'ai33','ai2021');  
 
	}catch (PDOException $e) { 
 
   	echo 'Connection failed: ' . $e->getMessage(); 
 
	}; 

if(isset($_POST["BotonGuardar"])){

   if(empty($password)==false && empty($password2)==false){
	
	if ($password == $password2){

		$pass_hash = sha1($password);

		$queryModificar = "UPDATE users SET users.name = '$nombre', users.edad = '$edad', 
		users.sex = '$sexo', users.ocupacion = '$ocupacion',  
		users.passwd = '$pass_hash' WHERE users.id =".$_COOKIE["sesion"];
		
		$result = $pdo->query($queryModificar); 


		if(empty($foto)==false){
			$queryy = "SELECT pic FROM users";
			$resultt = $pdo->query($queryy);
			while ($ll=$resultt->fetch(PDO::FETCH_ASSOC)){
				if ($ll['pic']==$foto){
					$i = 1;
					$nombreSinExtension = pathinfo($foto);
					$foto = $nombreSinExtension['filename'].$i.'.'.$nombreSinExtension['extension'];	
				}
			}	
			$queryFoto = "UPDATE users SET users.pic = '$foto' WHERE users.id =".$_COOKIE["sesion"];
			$result = $pdo->query($queryFoto);
			$ruta = 'fotos/'.$foto;
			move_uploaded_file($_FILES['Foto']['tmp_name'],$ruta);
		}
		

   		
		echo "<script>alert('Datos modificados')</script>";
 		echo "<script>window.location= 'miCuenta.php' </script>";


            		
	}else { 
		echo "<script> alert('Las contraseñas no coinciden. Pruebe de nuevo por favor')</script>";
		echo"<script>window.location= 'modificarDatos.php'</script>";
		}	
    }else { 
		echo "<script> alert('Introduzca la contraseña, por favor.')</script>";
		echo"<script>window.location= 'modificarDatos.php'</script>";	
	}

}
    

	





