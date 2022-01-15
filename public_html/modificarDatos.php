<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="css/estilo.css">
<title>Videorec</title>
</head>
<body>

<div class="mod">

<h1><a href ='main.php'>Videorec</a></h1>
<h1>Actualizar datos personales</h1>
<form action = "modificar.php" method="POST" enctype="multipart/form-data">

<?php
    	try {
		$pdo = new PDO('mysql:host=localhost;dbname=ai33', 'ai33','ai2021'); 
	}catch (PDOException $e) {
		 echo 'Connection failed: ' . $e->getMessage();
	};

	$query = "SELECT * FROM users WHERE users.id =".$_COOKIE["session"];
	$result = $pdo->query($query);

	while ($l=$result->fetch(PDO::FETCH_ASSOC)){
		
       echo " Nombre:<br><input name='Nombre' type= 'text' value = '".$l["name"]."'>";
	echo "<br><br>";
	echo "Contraseña:<br><input name='Password' type= 'password'>";
	echo 	"<br>";
       echo  "Confirmar Contraseña:<br><input name='Pass' type= 'password'>";
       echo  "<br><br>";
       echo  "Edad:<br><input name='Edad' type= 'text' value = '".$l["edad"]."'>";
	echo 	"<br><br>";
	echo "Sexo:";
	echo 	"<br>";

	if($l['sex'] == 'M'){
        	echo '<input type="radio" id="M" name="Sexo" value="M" checked>';
		echo '<label for="M">Hombre</label><br>';
		echo '<input type="radio" id="F" name="Sexo" value="F">';
		echo '<label for="F">Mujer</label>';
	}else{
		echo '<input type="radio" id="M" name="Sexo" value="M">';
		echo '<label for="M">Hombre</label><br>';
		echo '<input type="radio" id="F" name="Sexo" value="F" checked>';
		echo '<label for="F">Mujer</label>';
	}

	echo 	"<br><br>";
       echo  "Ocupación:<br><input name='Ocupacion' type= 'text' value = '".$l["ocupacion"]."'>";
	echo	"<br><br>";
       echo  "Foto de perfil:<br><input name='Foto' type= 'file' value = '".$l["pic"]."'>";
	echo	"<br><br>";
	echo "<td><img width ='150' heigth='211' src= 'fotos/".$l["pic"]."'></td>";
	echo	"<br><br>";
       echo  "<input type='submit' value='Guardar' name='BotonGuardar' style='background-color:lightyellow'>";
       echo  "<br><br><br>";      

	}
        

?>

</div>
        
</body>
</html>
