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
	<h1>Productos registrados</h1>
    <table border>
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Precio</th>
			<th>Descripción</th>
			<th>Acciones</th>
			
		</tr>
		<?php foreach($datos as $dato):?>
		<tr>
			<td><?php echo $dato[0] ?></td>
			<td><?php echo $dato[1] ?></td>
			<td><?php echo $dato[2] ?></td>
			<td><?php echo $dato[3] ?></td>
			<td><a href='<?php echo "actualizar.php?id=".$dato[0] ?>'>Actualizar</a></td>
		</tr>
		<?php endforeach?>
    </table>
	<hr>
	<h1>Nuevo producto</h1>
	<form method="POST" action="agregar.php">
		<label>Nombre</label>
		<input name="nombre" required><br>
		<label>Precio</label>
		<input name="precio" required type="Number"><br>
		<label>Descripción</label>
		<input name="descripcion"><br>
		<input type="submit" value="agregar">
	</form>
  </body>
</html>




