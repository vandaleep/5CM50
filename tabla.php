<?php
	ini_set('display_errors', E_ALL);
	
	include "mysqli_aux.php";
	
	$datos = seleccionar("SELECT * FROM producto", "localhost", "pruebas", "root", "toor");
	
	//echo count($datos);
?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <title>Tabla de dato</title>
  </head>
  <body>
    <table border>
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Descripción</th>
		</tr>
		<?php foreach($datos as $dato):?>
		<tr>
			<td><?php echo $dato[0] ?></td>
			<td><?php echo $dato[1] ?></td>
			<td><?php echo $dato[2] ?></td>
			<td><?php echo $dato[3] ?></td>
		</tr>
		<?php endforeach?>
    </table>
  </body>
</html>




