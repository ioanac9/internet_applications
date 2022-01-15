<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" type="text/css" href="styling/styles.css">
<title>TVTime</title>
</head>
<body>

<div class="mod">

<h1><a href ='principal.php'>TVTime</a></h1>
<h1>Update account information</h1>
<form action = "update.php" method="POST" enctype="multipart/form-data">

<?php
    	try {
		$pdo = new PDO('mysql:host=localhost;dbname=Asd', 'root','Rodeapps123');
	}catch (PDOException $e) {
		 echo 'Connection failed: ' . $e->getMessage();
	};

	$query = "SELECT * FROM users WHERE users.id =".$_COOKIE["sesion"];
	$result = $pdo->query($query);

	while ($l=$result->fetch(PDO::FETCH_ASSOC)){

       echo " Name:<br><input name='Name' type= 'text' value = '".$l["name"]."'>";
	echo "<br><br>";
	echo "Password:<br><input name='Password' type= 'password'>";
	echo 	"<br>";
       echo  "Confirm Password:<br><input name='Password' type= 'password'>";
       echo  "<br><br>";
       echo  "Age:<br><input name='Age' type= 'text' value = '".$l["edad"]."'>";
	echo 	"<br><br>";
	echo "Gender:";
	echo 	"<br>";

	if($l['sex'] == 'M'){
        	echo '<input type="radio" id="M" name="Gender" value="M" checked>';
		echo '<label for="M">Male</label><br>';
		echo '<input type="radio" id="F" name="Gender" value="F">';
		echo '<label for="F">Female</label>';
	}else{
		echo '<input type="radio" id="M" name="Gender" value="M">';
		echo '<label for="M">Male</label><br>';
		echo '<input type="radio" id="F" name="Gender" value="F" checked>';
		echo '<label for="F">Female</label>';
	}

	echo 	"<br><br>";
       echo  "Occupation:<br><input name='Occupation' type= 'text' value = '".$l["ocupacion"]."'>";
	echo	"<br><br>";
       echo  "Profile photo:<br><input name='Photo' type= 'file' value = '".$l["pic"]."'>";
	echo	"<br><br>";
	echo "<td><img width ='150' height='211' src= 'photos/".$l["pic"]."'></td>";
	echo	"<br><br>";
       echo  "<input type='submit' value='Submit' name='UpdateBtn' style='background-color:lightyellow'>";
       echo  "<br><br><br>";

	}


?>

</div>

</body>
</html>
