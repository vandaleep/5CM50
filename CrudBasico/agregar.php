<?php
    include "mysqli_aux.php";

    if( isset($_POST["nombre"]) && isset($_POST["precio"]) ) {
        //Insertar nuevo producto
        $nombre = $_POST["nombre"];
        $precio = $_POST["precio"];
        $descripcion = $_POST["descripcion"];
        $querote="INSERT INTO producto (nombre, precio, descripcion) VALUES ('$nombre','$precio','descripcion')";

        $id = insertar($querote, "localhost", "pruebas", "root", "toor");
	
        if ($id != 0) {
            echo "<h1 style='color:blue;'>Exito! Registro agregado</h1>";
        } else {
            echo "<h1 style='color:red;'>Operación inválida</h1>";
        }

    } else {
        echo "<h1 style='color:red;'>Operación inválida</h1>";
    }

    echo "<a href='lista.php'>Regresar</a>";
?>