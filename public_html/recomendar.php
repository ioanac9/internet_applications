<?php
	try {
		$ruta = "/home/alumnos/ai33/public_html/octave\r\n";
		$fun = "updateRecomendation(".$_COOKIE['sesion'].")\r\n";
		$info = $ruta.$fun.chr(0);
		
		$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		socket_connect($socket, "127.0.0.1", 1111);
		$sent = socket_write($socket, $info, strlen($info));
		
		echo "<script> alert('Se est√n actualizando sus recomendaciones, espere al menos unos 20 segundos antes de pulsar aceptar.')</script>";
		echo "<script>document.location = 'miCuenta.php'</script>";
	} catch (Exception $e) {
		echo $e->getMessage();
	}
?>