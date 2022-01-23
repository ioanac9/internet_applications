<?php
	try {
		$route = "/Applications/XAMPP/xamppfiles/htdocs/AI/internet_applications/public_html/mathlab\r\n";
		$update = "updateRecomendation(".$_COOKIE['session'].")\r\n";
		$info = $route.$update.chr(0);

		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		socket_connect($socket, "127.0.0.1", 1111);
		$sent = socket_write($socket, $info, strlen($info));

		echo "<script>document.location = '../pages/searchRecommended.php'</script>";
	} catch (Exception $e) {
		echo $e->getMessage();
	}
?>
