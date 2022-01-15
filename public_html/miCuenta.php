<html>

<link rel="stylesheet" href="css/estilo.css">
<script type='text/javascript'>
	function borrar(){
		var mensaje = window.confirm('¿Está seguro de eliminar su cuenta?');
		if (mensaje){
			window.location = 'eliminarCuenta.php';
		}else{
			window.location = 'miCuenta.php';
		}
			
	}
</script>
<head>

<title>Videorec</title>
</head>
<body>
<h1><a href = "main.php">Videorec</a></h1>
<h1 align='center'>Información de usuario</h1>

	<?php
    	try {
		$pdo = new PDO('mysql:host=localhost;dbname=ai33', 'ai33','ai2021'); 
	}catch (PDOException $e) {
		echo 'Connection failed: '. $e->getMessage();
	};
        
        $query = "SELECT * FROM users WHERE users.id=".$_COOKIE["session"];
	$result = $pdo->query($query);
        
        echo "<table border='1' align='center' style='width:100%'>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th width ='150' heigth='211'>Foto</th>";
        echo "<th>Nombre</th>";
        echo "<th>Edad</th>";
        echo "<th>Ocupación</th>";
        echo "<th></th>";
        echo "</tr>";
       
			while ($l=$result->fetch(PDO::FETCH_ASSOC)){
				echo "<tr>";
                		echo "<td>".$l["id"]."</td>";
               			echo "<td><img width ='150' heigth='211' src= 'fotos/".$l["pic"]."'></td>";
				echo "<td>".$l["name"]."</td>";
				echo "<td>".$l["edad"]."</td>";
				echo "<td>".$l["ocupacion"]."</td>";
                		echo "<td align='center'><a href='modificarDatos.php'><button>Actualizar datos</button></a><br><br>";
				echo "<form>";
				echo "<input type='button' onclick='borrar()' value='Eliminar cuenta' style='background-color:lightyellow'></form></td>";
				echo "</tr>";
			}
	echo "</table>";
	?>

<div align ="center">
<br><br><br>
<h2>Recomendaciones:</h2>
<br>
<a href='recomendar.php'><button>Actualizar recomendaciones</button></a>
<br><br>
<a href='mostrarRec.php'><button>Mostrar recomendaciones</button></a>
<br><br>
</div>	
	

		
</body>
</html>
