<html>
<head>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="css/estilo.css">

<!-- JQUERY -->
<script src="js/jquery-3.4.1.js"></script> 

<!-- DATATABLES -->
<script src="js/jquery.dataTables.min.js"></script>

<!-- BOOTSTRAP -->
<script src="js/dataTables.bootstrap4.min.js"></script>
    
    <style>
        th,td {
            padding: 0.4rem !important;
	    background-color: lightblue;
        }

	
    </style>

<title>Proyecto Aplicaciones en internet</title>

<link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<body>

<div class = "titulo">
<h1>Videorec</h1>
</div>

<div class="botones">
<?php 	
	if (isset($_COOKIE['session'])) {
		echo "<h2><a href='miCuenta.php'><button>Mi cuenta</button></a></h2>";
		echo "<form action='salir.php' method='GET'>";
		echo"<h2><input type='submit' name='salir' value='Cerrar sesión' style='background-color:lightyellow'></Input></h2>";
        }else
	{
		echo "<h2><a href='iniciarsession.html'><button>Iniciar sesión</button></a></h2>";
	}
?>
</div>
<div><h1 align='center'>Catálogo de películas</h1></div>


	<?php
    	try {
		$pdo = new PDO('mysql:host=localhost;dbname=ai33', 'ai33','ai2021'); 
	}catch (PDOException $e) {
		 echo 'Connection failed: ' . $e->getMessage();
	};
        
        $query = "SELECT * FROM movie";
	$result = $pdo->query($query);
        ?>

	<div class="container" style="margin-top: 10px;padding: 5px">

	<?php

        echo "<table id='tablax' class='table table-striped table-bordered' style='width:100%' border='1'>";
	echo "<thead>";
        echo "<th width ='150' heigth='211'>Cartel</th>";
        echo "<th>Título</th>";
        echo "<th>Puntuación</th>";
        echo "<th>Puntuación ponderada</th>";
        echo "<th>Fecha de estreno</th>";
	echo "</thead>";
	echo "<tbody>";

	$queryPonderada = "SELECT score FROM user_score";
	$resultPond = $pdo->query($queryPonderada);
	$suma2=0;
	$cnt2 = 0;
	while ($lll=$resultPond->fetch(PDO::FETCH_ASSOC)){
		$suma2 = $suma2 + $lll['score'];
		$cnt2 = $cnt2 + 1;
	}
	$media2 = $suma2/$cnt2;
       
			while ($l=$result->fetch(PDO::FETCH_ASSOC)){
				echo "<tr>";
               			echo "<td><img width ='150' heigth='211' src= 'images/".$l["url_pic"]."'></td>";
				echo "<td><a href='mostrarInfo.php?id=".$l['id']."'>".$l["title"]."</a></td>";
				echo "<td>";
				$queryScore = "SELECT score FROM user_score WHERE user_score.id_movie= ".$l['id'];
				$resultScore = $pdo->query($queryScore);
				$suma = 0;
				$cnt = 0;
					while ($ll=$resultScore->fetch(PDO::FETCH_ASSOC)){
					$suma = $suma + $ll['score'];
					$cnt = $cnt + 1;
					}

				
				$media = $suma/$cnt;
				echo $media;
				echo "<br>";
				echo "Puntuaciones totales: ".$cnt;
				echo "</td>";
				echo "<td>";	
				$pp = (1682*$media2 + $cnt*$media)/(1682+$cnt);
				echo $pp;
				echo "</td>";
                		echo "<td>".$l["date"]."</td>";
				echo "</tr>";
			}
	echo "</tbody>";
	echo "</table>";	
	?>
	</div>

    <script>
        $(document).ready(function () {
            $('#tablax').DataTable();
	});
    </script>

</body>
</html>
