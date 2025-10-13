<?php
	if( isset($_COOKIE["ejemplo"]) ) {
		echo "La cookie existe con valor: " . $_COOKIE["ejemplo"];
	} else {
		echo "La cookie no existe";
		$tiempo = 30;
		setcookie("ejemplo","1234",time()+ 30);
		echo "La cookie ahora existe por $tiempo segundos";
	}

?>
