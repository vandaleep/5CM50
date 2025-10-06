<?php
	$alumnitos = ["02" => "Mengano", "07" => "SUtano", "11" =>"Perengano", "15"=>"Juan"];
?>
<html>
	<head>
		<script>
			function guardar() {
				let a1 = document.getElementById("cbo02");
				let a2 = document.getElementById("cbo07");
				let a3 = document.getElementById("cbo11");
				let a4 = document.getElementById("cbo15");
				
				let c1 = parseInt(a1.value);
				let c2 = parseInt(a2.value);
				let c3 = parseInt(a3.value);
				let c4 = parseInt(a4.value);
				
				alert("No guardo, pero te muestro el promedio: " + (c1+c2+c3+c4)/4);
			}
			
		</script>
	</head>
	<body>
		<h1>Tus alumnos</h1>
		<table border>
			<tr>
				<th>Num</th>
				<th>Nombre</th>
				<th>Calificación</th>
			</tr>
			<?php foreach($alumnitos as $cve => $a):?>
			<tr>
				<td><?php echo $cve ?></td>
				<td><?php echo $a ?></td>	
				<td><select id="cbo<?php echo $cve ?>">
					<option>0</option>
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
					<option>10</option>
					<option>NP</option>
				</select></td>
			</tr>
			<?php endforeach?>
		</table>
		<input type="button" value="Guardar" onclick="guardar()">
	</body>
</html>
