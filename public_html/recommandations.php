<?php
	try {
		$ruta = "/home/alumnos/ai54/public_html/octave\r\n";
		$fun = "updateRecomendation(".$_COOKIE['session'].")\r\n";
		$info = $ruta.$fun.chr(0);

		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		socket_connect($socket, "127.0.0.1", 1111);
		$sent = socket_write($socket, $info, strlen($info));

		echo "<script>document.location = 'myAccount.php'</script>";
	} catch (Exception $e) {
		echo $e->getMessage();
	}
?>
