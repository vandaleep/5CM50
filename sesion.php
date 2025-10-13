<?php
	session_start();
	
	if ( isset($_SESSION["ejemplo"]) ) {
		echo "La sesion esta creada con valor: " . $_SESSION["ejemplo"];
	} else {
		echo "La sesion no existe<br>";
		$_SESSION["ejemplo"] = "1234";
		echo "... Pero ahora ya lo está";
	}
?>
