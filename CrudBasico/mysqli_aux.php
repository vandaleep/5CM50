<?php
	function ejecutar($query, $server, $base, $usr, $pass) {
		//Conectar a la BD y comprobar
		$cnx = mysqli_connect($server, $usr, $pass, $base);
		if (mysqli_connect_errno()) {
			return false;
		}
	
		$res = mysqli_query($cnx, $query);
		mysqli_close($cnx);

		return $res;
	}

	function insertar($query, $server, $base, $usr, $pass) {
		//Conectar a la BD y comprobar
		$cnx = mysqli_connect($server, $usr, $pass, $base);
		if (mysqli_connect_errno()) {
			return false;
		}
	
		$res = mysqli_query($cnx, $query);
		$id = mysqli_insert_id($cnx);
		
		mysqli_close($cnx);

		return $id;
	}

	function seleccionar($query, $server, $base, $usr, $pass) {
		$resultados = [];
		
		//Conectar a la BD y comprobar
		$cnx = mysqli_connect($server, $usr, $pass, $base);
		if (mysqli_connect_errno()) {
			return false;
		}
		
		//Recupera registros de la base de datos
		$res = mysqli_query($cnx, $query);
		while ($registro = mysqli_fetch_row($res) ) {
			$resultados[] = $registro;
		}
		
		//Libera objetos de datos empleados
		mysqli_free_result($res);
		mysqli_close($cnx);
		
		return $resultados;
	}

//Cuando es un archivo de librería, no se cierra la etiqueta de servidor
