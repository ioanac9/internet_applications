<html>

<link rel="stylesheet" href="styling/styles.css">
<script type='text/javascript'>
	function remove(){
		var mensaje = window.confirm('Are you sure you want to delete your account?');
		if (mensaje){
			window.location = 'removeAccount.php';
		}else{
			window.location = 'myAccount.php';
		}

	}
</script>
<head>

<title>TVTime</title>
</head>
<body>
<h1><a href = "principal.php">TVTime</a></h1>
<h1>My account</h1>

	<?php
    	try {
		$pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
	}catch (PDOException $e) {
		echo 'Connection failed: '. $e->getMessage();
	};

        $query = "SELECT * FROM users WHERE users.id=".$_COOKIE["sesion"];
	$result = $pdo->query($query);

			while ($l=$result->fetch(PDO::FETCH_ASSOC)){
			    echo "<div>";
			    echo "<div class='account-container'>";
               	echo "<img width ='150' heigth='211' src= 'fotos/".$l["pic"]."'>";
				echo "<div class='account-info'>";
				echo "<div><span class='desc'>Name: </span>".$l["name"]."</div>";
				echo "<div><span class='desc'>Age: </span>".$l["edad"]."</div>";
				echo "<div><span class='desc'> Occupation: </span>".$l["ocupacion"]."</div>";
                 echo "<div class='btn-container'><a href='updateData.php'><button class='submit-btn'>Update your information</button></a>";
                 echo "<input type='button' class='submit-btn remove' onclick='remove()' value='Delete account'></div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";

			}
	echo "</div>";
	?>

<div align ="center">
<h2>Recomendaciones:</h2>
<br>
<a href='recommandations.php'><button>Update recommandations</button></a>
<br><br>
<a href='searchRecommended.php'><button>Search recommandations</button></a>
<br><br>
</div>



</body>
</html>
